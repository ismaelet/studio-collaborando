<?php

namespace App\Http\Middleware;

use App\Models\Admin\AdminCategory;
use App\Models\Admin\AdminSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        $user = $request->user();
        $links = collect(config('custom.header_navigation_links', []))
            ->filter(fn ($link) => (! ($link['admin_only'] ?? false) || $user?->isAdmin())
                && (! array_key_exists('auth', $link) || $link['auth'] === (bool) $user))
            ->map(fn ($link) => [...$link, 'url' => route($link['url']),
                'label' => str_contains($link['label'], '{{') ? ($user?->fullName() ?: $user?->email) : $link['label']])
            ->values();

        return [...parent::share($request),
            'adminNavigation' => fn () => $user?->isAdmin() && $request->is('admin/*') ? $this->adminNavigation($user->isSupervisor()) : [],
            'auth' => ['user' => $user?->only('id', 'name', 'first_name', 'last_name', 'email', 'admin_level')],
            'site' => [
                'name' => config('app.name'),
                'navigation' => $links,
                'footer' => collect(config('custom.footer_navigation_links', []))->map(fn ($links) => collect($links)->map(function ($link) {
                    if (isset($link['social_media'])) {
                        return config('custom.social_media.'.$link['social_media']);
                    }

                    return [...$link, 'url' => isset($link['url']) ? route($link['url']) : null];
                })),
                'social' => config('custom.social_media', []),
            ],
            'flash' => fn () => collect(['status', 'success', 'submitted', 'not_found', 'email', 'error', 'newsletterSuccess'])
                ->mapWithKeys(fn ($key) => [$key => $request->session()->get($key)]),
        ];
    }

    private function adminNavigation(bool $supervisor): array
    {
        return AdminCategory::query()
            ->when(! $supervisor, fn ($query) => $query->where('for_supervisors', false))
            ->orderBy('for_supervisors')->orderBy('order')->orderBy('name')->get()
            ->map(fn ($category) => [
                'name' => $category->name,
                'items' => AdminSection::where('category_id', $category->id)
                    ->where('hidden', false)
                    ->when(! $supervisor, fn ($query) => $query->where('for_supervisors', false))
                    ->orderBy('order')->orderBy('resource', 'desc')->orderBy('action')->orderBy('name')->get()
                    ->filter(fn ($section) => Route::has($section->routeName()))
                    ->map(fn ($section) => ['name' => $section->name, 'url' => $section->url()])->values(),
            ])->all();
    }
}
