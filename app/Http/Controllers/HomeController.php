<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('selfPage');
    }


    public function getGoods(Request $request)
    {
        $user = Auth::user();
        if ($user->role == "buyer") {
            $goods = DB::table('auctions')
                ->where([
                    ['user_id', '=', $user->id],
                    ['accepted_by_buyer', '=', 0]
                ])
                ->select('*')
                ->get();
        }
        else{
            $goods = DB::table('auctions')
                ->where([
                    ['user_id', '=', $user->id],
                    ['deleted', '=', 0]
                ])
                ->select('*')
                ->get();
        }

        echo \response()->json(array('goods'=>$goods));
    }
}
