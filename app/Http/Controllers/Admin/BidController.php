<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bids = Bid::with('user')->paginate(20);
        return view('admin.dashboard',compact('bids'));
    }
    public function approve(Bid $bid)
    {
        $bid->approve();
        return redirect()->back()->with('status','Bid is successfully approved');
    }
}
