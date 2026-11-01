<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserCoursesController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $purchased = in_array($user->email, config('ecommerce.course_access_emails', []), true)
            || Cart::where('statusId', '>', 0)->where('customerId', $user->id)->exists();
        $videos = $purchased ? collect(Storage::disk('public')->files('courses/1'))
            ->filter(fn ($file) => pathinfo($file, PATHINFO_EXTENSION) === 'mp4')
            ->map(fn ($file) => ['name' => pathinfo($file, PATHINFO_FILENAME), 'url' => Storage::disk('public')->url($file)])
            ->values() : [];

        return Inertia::render('UserDashboard/Courses', compact('purchased', 'videos'));
    }
}
