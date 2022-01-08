<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Position;
use App\BillPosition;
use Illuminate\Http\Request;
use DB;
use Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bills_index()
    {
        $totol_positions = 0;
        $open_bills = 0;
        $total_bills = 0;

        $total_positions = DB::table('positions')
            ->where('user', Auth::user()->id)
            ->sum('amount');

        $open_bills =DB::table('bills')
            ->where('user', Auth::user()->id)
            ->where('open', 1)
            ->count('id');

        $total_bills =DB::table('bills')
            ->where('user', Auth::user()->id)
            ->where('open', 1)
            ->sum('total');
        
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

        $bills = DB::table('bills')
            ->where('user', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('user.bills')->with(compact('total_positions', 'open_bills', 'total_bills', 'positions', 'bills'));
    }

    public function bill_index($id)
    {
        $amount = DB::table('bills')
            ->where('id', $id)
            ->pluck('amount')
            ->first();

        $invoice = DB::table('bills')
            ->where('id', $id)
            ->pluck('invoice')
            ->first();
    
        $start_date = DB::table('invoices')
            ->where('id', $id)
            ->pluck('start_date')
            ->first();
        
        $end_date = DB::table('invoices')
            ->where('id', $id)
            ->pluck('end_date')
            ->first();
        
        $term = DB::table('bills')
            ->where('id', $id)
            ->pluck('term')
            ->first();

        $open= DB::table('bills')
            ->where('id', $id)
            ->pluck('open')
            ->first();

        $positions = BillPosition::select(
            'bill_positions.id',
            'bill_positions.article',
            'bill_positions.quantity',
            'bill_positions.amount',
            'articles.name',
            'articles.price',
        )
        ->join('articles', 'bill_positions.article', '=', 'articles.id')
        ->where('bill', $id)
        ->get();

        return view('user.bill')->with(compact('amount', 'start_date', 'end_date', 'term', 'open', 'positions'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
