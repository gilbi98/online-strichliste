<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Position;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $positions = Position::select(
                'positions.id',
                'positions.article',
                'positions.quantity',
                'positions.amount',
                'articles.name',
                'articles.price',
        )
        ->join('articles', 'positions.article', '=', 'articles.id')
        ->where('user', Auth::user()->id)
        ->get();

        return view('user/home')->with(compact('positions'));
    }
}
