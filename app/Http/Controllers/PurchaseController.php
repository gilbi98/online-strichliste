<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Position;
use App\Invoice;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
/** use Illuminate\Support\Facades\Cookie; */

class PurchaseController extends Controller
{
    public $purchase;
    public $invoice;

    public function __construct()
    {
        $this->purchase = new Purchase;
        $this->invoice = new Invoice;
    }

    public function index()
    { 

        $currentDate = Carbon::now()->toDateTimeString();

        return view('admin.purchases', ['purchases' => $this->purchase->getPurchasesByArticles(), 'last_invoiceInterval' => $this->invoice->getLastInvoiceInterval(), 'last_invoiceDate' => $this->invoice->getLastInvoiceDate(), 'currentDate' => $currentDate]);
        //return $this->purchase->getPurchasesByArticles();
        //return DB::table('purchases')->leftJoin('articles', 'purchases.article', 'articles.id')->select('purchases.article AS article_id', 'articles.name AS article_name')->groupBy('purchases.article')->get()->toArray();
    }
    /**
     * 1. create type of purchase through calling different methods
     * 2. store purchase
     * 3. store purchase in position
     */
    public function createPurchaseWithoutCategory(Request $request)
    { 

        $this->validate($request, [
            'article' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $user = Auth::user()->id;
        $article = $request->input('article');
        $quantity = $request->input('quantity');

        $price = DB::table('articles')->where('id', '=', $article)->value('price');
        $cost = $price * $quantity;

        $purchase = new Purchase;
        $purchase->date = Carbon::now()->toDateTimeString();
        $purchase->user = $user;
        $purchase->article = $request->input('article');
        $purchase->quantity = $request->input('quantity');
        $purchase->cost = $cost;
        $purchase->save();

        return redirect()->route('cart')->with('message', 'Die Entnahme wurde eingetragen');
    }

    public function createPurchaseWithCategory(Request $request)
    { 

        $this->validate($request, [
            'category' => 'required|numeric',
            'article' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $user = Auth::user()->id;
        $article = $request->input('article');
        $quantity = $request->input('quantity');

        $price = DB::table('articles')->where('id', '=', $article)->value('price');
        $cost = $price * $quantity;

        $purchase = new Purchase;
        $purchase->date = Carbon::now()->toDateTimeString();
        $purchase->user = $user;
        $purchase->article = $article;
        $purchase->quantity = $quantity;
        $purchase->cost = $cost;
        $purchase->save();

        return redirect()->route('cart')->with('message', 'Die Entnahme wurde eingetragen');
    }

    public function createPurchaseWithoutCategoryOutside(Request $request)
    { 

        $this->validate($request, [
            'article' => 'required|numeric',
            'quantity' => 'required|integer',
            'ssn_1' => 'required|integer',
            'ssn_2' => 'required|integer',
            'ssn_3' => 'required|integer',
            'ssn_4' => 'required|integer',
        ]);

        $sc = 1234; /** Cookie::get("kiosk_pin"); */
        

        $user = $this->getUser($request->input('ssn_1'), $request->input('ssn_2'), $request->input('ssn_3'), $request->input('ssn_4'), $sc);
        
        if($user == false){
            return redirect()->route('outside')->withErrors('PIN nicht korrekt oder kein Cookie hinterlegt');
        }

        $article = $request->input('article');
        $quantity = $request->input('quantity');

        $purchase = $this->store($user, $article, $quantity);

        return redirect()->route('outside')->with('message', 'Die Entnahme wurde eingetragen');
    }

    private function getUser($pc1, $pc2, $pc3, $pc4, $sc)
    {
        /**
        * Check if pin code from form matches
         */
        if($user = DB::table('users')->where('pc1', $pc1)->where('pc2', $pc2)->where('pc3', $pc3)->where('pc4', $pc4)->exists()){

            $user = DB::table('users')
                ->where('pc1', $pc1)
                ->where('pc2', $pc2)
                ->where('pc3', $pc3)
                ->where('pc4', $pc4)
                ->pluck('id')
                ->first();

            if($this->checkUserPin($user, $sc) == true){
                return $user;
            }
            else{
                return false;
            }

        }
        
        else{
            return false;
        }
           
    }

    private function checkUserPin($user, $sc)
    {
        if(DB::table('users')->where('id', $user)->where('sc', $sc)->exists()){
            return true;
        }
        else{
            return false;
        }
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

}
