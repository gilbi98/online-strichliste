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

class TallysheetController extends Controller
{
    public function index()
    {
        $articles = DB::table('articles')
            ->get();

        $categories = DB::table('categories')
            ->get();

        return view('user.cart')->with(compact('articles', 'categories'));
    }

    public function outside_index()
    {
        $articles = DB::table('articles')
            ->get();

        $categories = DB::table('categories')
            ->get();

        return view('outside.cart')->with(compact('articles', 'categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Tallysheet $tallysheet)
    {
        //
    }

    public function edit(Tallysheet $tallysheet)
    {
        //
    }

    public function update(Request $request, Tallysheet $tallysheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tallysheet  $tallysheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tallysheet $tallysheet)
    {
        //
    }
}
