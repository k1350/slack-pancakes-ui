<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TotalPancake;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 現在認証されているユーザーの取得
        $user = Auth::user();
        // total取得
        $total = TotalPancake::where('user_id', $user->user_id)
        ->select('received', 'sent', 'used')
        ->firstOrFail();

        return view('home')
        ->with('total', $total);
    }
}
