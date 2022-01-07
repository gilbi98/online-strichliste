<?php

namespace App\Http\Controllers;

use App\Tallysheet;
use Illuminate\Http\Request;

class TallysheetController extends Controller
{
    public function index()
    {
        return view('user.cart');
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
