<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::orderBy('created_at', 'desc')->get(); 
        return view('dashboard', compact('subscribers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create($data);

        return back()->with('success', 'Merci pour votre inscription !');
    }
}
