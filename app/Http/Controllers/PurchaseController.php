<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Position;
use Illuminate\Http\Request;
use DB;
use Auth;

class PurchaseController extends Controller
{
    
    public function index()
    {
        //
    }

    /**
     * 1. create type of purchase through calling different methods
     * 2. store purchase
     * 3. store purchase in position
     */
    public function createPurchaseWithoutCategory(Request $request)
    { 

        $user = Auth::user()->id;
        $article = $request->input('article');
        $quantity = $request->input('quantity');

        $purchase = $this->store($user, $article, $quantity);

        return redirect()->route('cart')->with('message', 'Die Entnahme wurde eingetragen');
    }

    public function createPurchaseWithCategory(Request $request)
    { 

        $user = Auth::user()->id;
        $article = $request->input('article');
        $quantity = $request->input('quantity');

        $purchase = $this->store($user, $article, $quantity);

        return redirect()->route('cart')->with('message', 'Die Entnahme wurde eingetragen');
    }

    /**
     * Create purchase
     */
    private function store($user, $article, $quantity)
    {
        $purchase = new Purchase;   
        $purchase->user = $user;
        $purchase->article = $article;
        $purchase->quantity = $quantity;
        $purchase->save();

        $this->storePosition($user, $article, $quantity);
    }

    /**
     * Create purchase in users positions
     */
    public function storePosition($user, $article, $quantity)
    {
        if(DB::table('positions')->where('user', $user)->where('article', $article)->exists()){
            
            $quantity_old = DB::table('positions')
                ->where('user', $user)
                ->where('article', $article)
                ->pluck('quantity')
                ->first();

            $quantity_new = $quantity_old + $quantity;

            $amount_new = $this->getNewPositionAmount($user, $article, $quantity);
            
            DB::table('positions')
                ->where('user', $user)
                ->where('article', $article)
                ->update(['quantity' => $quantity_new, 'amount' => $amount_new]);
        }
        else{

            $position = new Position;
            $position->user = $user;
            $position->article = $article;
            $position->quantity = $quantity;
            $position->amount = $this->getPurchaseAmount($article, $quantity);
            $position->save();

        }

    }

    public function getNewPositionAmount($user, $article, $quantity)
    {   
        $amount_old = DB::table('positions')
            ->where('user', $user)
            ->where('article', $article)
            ->pluck('amount')
            ->first();

        $price = $this->getArticlePrice($article);

        $costs = $quantity * $price;

        $amount_new = $amount_old + $costs;

        return $amount_new;
    }

    public function getArticlePrice($article)
    {
        return DB::table('articles')->where('id', $article)->pluck('price')->first();
    }

    public function getPurchaseAmount($article, $quantity)
    {
        $price = DB::table('articles')->where('id', $article)->pluck('price')->first();

        return $price * $quantity;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
