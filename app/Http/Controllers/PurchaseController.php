<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use DB;
use Auth;

class PurchaseController extends Controller
{
    
    public function index()
    {
        //
    }

    public function createPurchaseWithoutCategory(Request $request)
    {
        $user = Auth::user()->id;
        $article = $request->input('article');
        $quantity = $request->input('quantity');

        $purchase = $this->create($user, $article, $quantity);

        return redirect()->route('cart')->with('message', 'Die Entnahme wurde eingetragen');
    }

    /**
     * Create purchase
     */
    public function create($user, $article, $quantity)
    {
        $purchase = new Purchase;   
        $purchase->user = $user;
        $purchase->article = $article;
        $purchase->quantity = $quantity;
        $purchase->save();

        return true;
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
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
