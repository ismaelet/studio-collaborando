<?php

namespace Tests\Feature;

use App\Mail\GenericMail;
use App\Mail\Welcome;
use App\Models\User;
use App\Models\User\UserReset;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Inertia\Middleware;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class InertiaMigrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('admin_level')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->timestamps();
        });
        Schema::create('admin_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->boolean('hidden')->default(false);
            $table->boolean('for_supervisors')->default(false);
            $table->integer('order')->default(0);
            $table->string('name');
            $table->string('resource');
            $table->string('action');
        });
        Schema::create('admin_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('order');
            $table->boolean('for_supervisors');
            $table->timestamps();
        });
        Schema::create('ecommerce_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('statusId');
            $table->integer('customerId');
            $table->dateTime('time')->nullable();
        });
        Schema::create('ecommerce_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('cartId');
            $table->dateTime('time');
            $table->decimal('staticFullPrice');
        });
        Storage::fake('public');
        Mail::fake();
    }

    private function user(bool $admin = false): User
    {
        $user = User::create(['first_name' => 'Sara', 'last_name' => 'Test', 'email' => 'sara@example.com', 'password' => Hash::make('password')]);
        $user->forceFill(['admin_level' => $admin ? 1 : 0])->save();

        return $user;
    }

    public function test_public_routes_render_svelte_pages_and_inertia_navigation(): void
    {
        foreach (['/', '/home', '/services', '/pet-therapy', '/courses', '/contacts', '/privacy'] as $url) {
            $this->get($url)->assertOk()->assertInertia(fn (Assert $page) => $page->component('Home')->has('site.navigation')->where('auth.user', null));
        }
        $this->get('/', ['X-Inertia' => 'true', 'X-Inertia-Version' => app(Middleware::class)->version(request())])->assertOk()->assertHeader('X-Inertia', 'true')->assertJsonPath('component', 'Home');
    }

    public function test_guest_authentication_pages_and_validation(): void
    {
        foreach (['login' => 'Login', 'register' => 'Register', 'recover' => 'Recover'] as $url => $component) {
            $this->get('/'.$url)->assertOk()->assertInertia(fn (Assert $page) => $page->component('Auth/'.$component));
        }
        $this->get('/reset?user_id=1&security_code=token')->assertInertia(fn (Assert $page) => $page->component('Auth/Reset')->where('securityCode', 'token'));
        $this->get('/reset')->assertRedirect('/recover');
        $this->post('/login', [])->assertSessionHasErrors(['email', 'password']);
        $this->post('/newsletter', ['email' => 'invalid'])->assertSessionHasErrors('email');
    }

    public function test_login_dashboard_profile_password_and_logout(): void
    {
        $user = $this->user();
        $this->post('/login', ['email' => $user->email, 'password' => 'password'])->assertRedirect('/user-dashboard');
        Storage::disk('public')->put('free/material.pdf', 'test');
        $this->get('/user-dashboard')->assertInertia(fn (Assert $page) => $page->component('UserDashboard/Recap')->has('materials', 1)->missing('auth.user.password'));
        $this->get('/user-dashboard/personal-data')->assertInertia(fn (Assert $page) => $page->component('UserDashboard/PersonalData'));
        $this->get('/user-dashboard/courses')->assertInertia(fn (Assert $page) => $page->component('UserDashboard/Courses')->where('purchased', false)->has('videos', 0));
        $this->post('/user-dashboard/personal-data', ['first_name' => 'Updated', 'last_name' => 'Test', 'email' => $user->email])->assertSessionHasNoErrors();
        $this->assertSame('Updated', $user->fresh()->first_name);
        $this->post('/user-dashboard/password', ['old_password' => 'wrong', 'password' => 'new-password', 'password_confirmation' => 'new-password'])->assertSessionHasErrors('old_password');
        $this->post('/user-dashboard/password', ['old_password' => 'password', 'password' => 'new-password', 'password_confirmation' => 'new-password'])->assertSessionHasNoErrors();
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
        $this->get('/logout')->assertInertia(fn (Assert $page) => $page->component('Auth/Logout'));
        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_course_access_only_exposes_videos_to_purchasers(): void
    {
        $user = $this->user();
        Storage::disk('public')->put('courses/1/lesson.mp4', 'test');
        DB::table('ecommerce_carts')->insert(['statusId' => 1, 'customerId' => $user->id]);
        $this->actingAs($user)->get('/user-dashboard/courses')->assertInertia(fn (Assert $page) => $page->component('UserDashboard/Courses')->where('purchased', true)->has('videos', 1));
    }

    public function test_newsletter_submission_replaces_livewire(): void
    {
        $this->from('/')->post('/newsletter', ['email' => 'reader@example.com'])->assertRedirect('/')->assertSessionHas('newsletterSuccess', true);
        $this->assertDatabaseHas('newsletter_subscribers', ['email' => 'reader@example.com']);
        Mail::assertSent(Welcome::class);
        $this->post('/newsletter', ['email' => 'reader@example.com'])->assertSessionHasErrors('email');
    }

    public function test_admin_pages_are_protected_and_render_serializable_resources(): void
    {
        $this->get('/admin/users')->assertRedirect('/login');
        $user = $this->user();
        $this->actingAs($user)->get('/admin/users')->assertRedirect('/login');
        $user->forceFill(['admin_level' => 1])->save();
        $this->get('/admin/dashboard')->assertOk()->assertInertia(fn (Assert $page) => $page->component('Admin/Dashboard')->has('widgets', 4)->has('revenues', 2));
        $this->get('/admin/users')->assertInertia(fn (Assert $page) => $page->component('Admin/Index')->has('records', 1)->missing('records.0.password'));
        $this->get('/admin/users/'.$user->id.'/edit')->assertInertia(fn (Assert $page) => $page->component('Admin/Edit')->where('resource', 'users')->missing('record.password'));
        $this->get('/admin/newsletter-subscribers')->assertOk()->assertInertia(fn (Assert $page) => $page->component('Admin/Index'));
        $this->get('/admin/admin-categories')->assertInertia(fn (Assert $page) => $page->component('Admin/Index'));
        $this->get('/admin/admin-categories/create')->assertInertia(fn (Assert $page) => $page->component('Admin/Edit')->where('record', null));
        $this->post('/admin/admin-categories', ['name' => 'Category', 'slug' => 'category', 'order' => 1, 'for_supervisors' => false])->assertRedirect('/admin/admin-categories');
        $this->get('/admin/admin-categories/1/edit')->assertInertia(fn (Assert $page) => $page->component('Admin/Edit'));
        $this->put('/admin/admin-categories/1', ['name' => 'Changed', 'slug' => 'category', 'order' => 2, 'for_supervisors' => false])->assertSessionHasNoErrors();
        $this->delete('/admin/admin-categories/1')->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('admin_categories', ['id' => 1]);
    }

    public function test_registration_and_password_recovery_keep_their_redirect_flows(): void
    {
        Schema::create('user_resets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('security_code');
            $table->timestamps();
        });
        $this->post('/register', [
            'first_name' => 'New', 'last_name' => 'Member', 'email' => 'new@example.com',
            'password' => 'password', 'password_confirmation' => 'password',
        ])->assertRedirect('/user-dashboard');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['first_name' => 'New', 'last_name' => 'Member']);
        $user = User::first();
        $this->post('/logout');
        $this->from('/recover')->post('/recover', ['email' => $user->email])->assertRedirect('/recover')->assertSessionHas('submitted', true);
        Mail::assertSent(GenericMail::class);
        UserReset::where('user_id', $user->id)->first()->update(['security_code' => 'known-token']);
        $this->from('/reset?user_id='.$user->id.'&security_code=known-token')->post('/reset', [
            'user_id' => $user->id, 'security_code' => 'known-token',
            'password' => 'changed', 'password_confirmation' => 'changed',
        ])->assertSessionHas('submitted', true);
        $this->assertTrue(Hash::check('changed', $user->fresh()->password));
        $this->assertDatabaseCount('user_resets', 0);
    }

    public function test_error_pages_render_svelte_and_json_errors_stay_json(): void
    {
        $this->get('/missing-page')->assertNotFound()->assertInertia(fn (Assert $page) => $page->component('Error')->where('status', 404));
        $this->getJson('/missing-page')->assertNotFound()->assertJsonStructure(['message']);
    }
}
