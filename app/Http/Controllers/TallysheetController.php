<?php

namespace App\Http\Controllers;

use App\Tallysheet;
use App\Article;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use Session;
use Illuminate\Support\Facades\Cookie;

class TallysheetController extends Controller
{

    public function index()
    {
        $articles = DB::table('articles')->where('status', '=', 1)->get();

        $categories = DB::table('categories')->get();

        return view('user.cart')->with(compact('articles', 'categories'));
    }

    public function outside_index()
    {
        $articles = DB::table('articles')->get();

        $categories = DB::table('categories')->get();

        $cookie = Cookie::get('kiosk');

        $name = DB::table('users')->where('sc', $cookie)->value('firstname');

        return view('user.cartOutside')->with(compact('articles', 'categories', 'cookie', 'name'));
    }

}
