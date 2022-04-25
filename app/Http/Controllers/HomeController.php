<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect( $this->redirectPath());
    }

    public function redirectPath()
    {
        if (Auth::user()->isManager()) {
            return route('admin');
        }

        if (Auth::user()->isUser()){
            return route('user');
        }

    }
}
