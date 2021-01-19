<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * 
     * 
     * Route middleware may be used to only allow verified users to access a given route. Laravel ships with a verified middleware, which references the Illuminate\Auth\Middleware\EnsureEmailIsVerified class. Since this middleware is already registered in your application's HTTP kernel, all you need to do is attach the middleware to a route definition:
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with("posts", $user->posts);
    }
}
