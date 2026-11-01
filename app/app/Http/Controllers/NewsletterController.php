<?php

namespace App\Http\Controllers;

use App\Models\Newsletter\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(['email' => ['required', 'email', 'unique:newsletter_subscribers,email']]);
        Subscriber::createAndSend($data);

        return back()->with('newsletterSuccess', true);
    }
}
