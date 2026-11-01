<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserRecapController extends Controller
{
    public function index()
    {
        $materials = collect(Storage::disk('public')->files('free'))
            ->filter(fn ($file) => pathinfo($file, PATHINFO_EXTENSION) === 'pdf')
            ->map(fn ($file) => ['name' => pathinfo($file, PATHINFO_FILENAME), 'url' => Storage::disk('public')->url($file)])
            ->values();

        return Inertia::render('UserDashboard/Recap', ['title' => 'Profilo', 'materials' => $materials]);
    }
}
