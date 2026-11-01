<?php

namespace App\Http\Controllers;

use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the homepage
     */
    public function index(): Response
    {
        return inertia('Home', [
            'title' => null,
            'location' => 'home',
        ]);
    }
}
