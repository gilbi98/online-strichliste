<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Purchase;
use Auth;

class Bill extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'number', 'term', 'user', 'amount', 'total', 'invoice'
    ];

    //bills overview methods
    public function getUsersPositionsAmount($user)
    {
        return DB::table('positions')->where('user', $user)->sum('amount');
    }

    public function getUsersOpenBillsQuantity($user)
    {
        return DB::table('bills')->where('user', $user)->where('open', 1)->count('id');
    }

    public function getUsersOpenBillsAmount($user)
    {
        return DB::table('bills')->where('user', $user)->where('open', 1)->sum('total');
    }
       
    public function getUsersPurchasesPaginate($user, $paginate)
    {
        return Purchase::select('purchases.created_at AS date','purchases.quantity AS quantity','articles.name','articles.price',)->join('articles', 'purchases.article', '=', 'articles.id')->where('user', Auth::user()->id)->paginate($paginate);
    }
        
    public function getUsersBillsPaginate($user, $paginate)
    {
        return  DB::table('bills')->where('user', Auth::user()->id)->orderBy('id', 'desc')->paginate($paginate);
    }

    //specific bill methods

    public function getBillAmount($bill)
    {
        return DB::table('bills')->where('id', $bill)->value('amount');
    }

    public function getInvoiceId($bill)
    {
        return DB::table('bills')->where('id', $bill)->value('invoice');
    }

    public function getStartDate($bill)
    {
        $invoice = $this->getInvoiceId($bill);

        return DB::table('invoices')->where('id', $invoice)->value('start_date');
    }
    
    public function getEndDate($bill)
    {
        $invoice = $this->getInvoiceId($bill);

        return DB::table('invoices')->where('id', $invoice)->value('end_date');
    }
        
    public function getTerm($bill)
    {
        return DB::table('bills')->where('id', $bill)->value('term');
    }
      
    public function getPaymentStatus($bill)
    {
        return DB::table('bills')->where('id', $bill)->value('open');
    }
    
    public function getBillPositions($bill)
    {
        return BillPosition::select('bill_positions.id','bill_positions.article','bill_positions.quantity','bill_positions.amount','articles.name','articles.price',)->join('articles', 'bill_positions.article', '=', 'articles.id')->where('bill', $bill)->get();
    }
       
}
