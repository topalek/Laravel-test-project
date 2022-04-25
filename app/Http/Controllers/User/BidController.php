<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BidRequest;
use App\Mail\NewBidMail;
use App\Models\Bid;
use App\Services\BidRegisterService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class BidController extends Controller
{
    public BidRegisterService $service;
    public $userCookieKey;

    public function __construct(BidRegisterService $service)
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->userCookieKey = 'user-' . Auth::id();
            return $next($request);
        });

        $this->service = $service;
    }

    public function index()
    {
        $canSend = false;
        if (Cookie::has($this->userCookieKey)) {
            $canSend = true;
        }
        session()->forget($this->userCookieKey);
        return view('user.dashboard', compact('canSend'));
    }

    public function store(BidRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->service->register($request);

        session([$this->userCookieKey => 'canSend']);

        return redirect()->route('user')->with('status','Your Bid is registered')->cookie($this->userCookieKey, time(), 60 * 24);
    }
}
