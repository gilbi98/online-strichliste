<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Purchase;
use App\Bill;
use Auth;
use Carbon\Carbon;

class Bill extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'number', 'term', 'user', 'amount', 'total', 'invoice'
    ];

    public $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }


    //bills overview methods
    public function getUsersPositionsAmount($user)
    {
        $amount = 0;

        $amount = DB::table('positions')->where('user', $user)->sum('amount');

        return $amount;
    }

    public function getUsersOpenBillsQuantity($user)
    {
        $openBills = 0;

        $openBills = DB::table('bills')->where('user', $user)->where('open', 1)->count('id');

        return $openBills;
    }

    public function getUsersOpenBillsAmount($user)
    {
        $amount = 0;

        $amount = DB::table('bills')->where('user', $user)->where('open', 1)->sum('total');

        return $amount;
    }
       
    public function getUsersPurchasesPaginate($user, $paginate)
    {
        return Purchase::select('purchases.created_at AS date','purchases.quantity AS quantity','articles.name','articles.price',)->join('articles', 'purchases.article', '=', 'articles.id')->where('user', Auth::user()->id)->orderBy('purchases.id', 'desc')->paginate($paginate);
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
        //return BillPosition::select('bill_positions.id','bill_positions.article','bill_positions.quantity','bill_positions.amount','articles.name','articles.price',)->join('articles', 'bill_positions.article', '=', 'articles.id')->where('bill', '=', $bill)->get();
        //return DB::table('positions')->where('bill', $bill)->get();
        return Position::select('positions.article as aricle_id', 'articles.name as article', 'positions.quantity', 'positions.amount')->join('articles', 'positions.article', '=', 'articles.id')->where('bill', '=', $bill)->get();
    }

    public function getUsersForBills($start, $end)
    {
        return DB::table('purchases')->where('date', '>=', $start)->where('date', '<=', $end)->groupBy('user')->pluck('user')->toArray();
    }

    public function getBillData($users, $start, $end)
    {
        $billData = array();

        for($i=0; $i<count($users); $i++){
            //add position to array
            $billData[$i] = array();
            $billData[$i]['user'] = $users[$i];
            $billData[$i]['amount'] = DB::table('purchases')->where('user', '=', $users[$i])->where('date', '>=', $start)->where('date', '<=', $end)->groupBy('user')->sum('cost');

            //delete position from database
            
        }

        return $billData;
    }

    public function createBills($billData)
    {
        $invoice = DB::table('invoices')->orderBy('id', 'desc')->value('id');
        
        for($i=0; $i<count($billData); $i++){

            $bill = new Bill;
            $bill->number = $this->generateBillNumber($invoice, $billData[$i]['user']);
            $bill->term = '2022-1-1';
            $bill->user = $billData[$i]['user'];
            $bill->amount = $billData[$i]['amount'];
            $bill->total = $billData[$i]['amount'];
            $bill->invoice = $invoice;
            $bill->open = 1;
            $bill->save();

        }
    }

    public function generateBillNumber($id, $user)
    {
        $year = Carbon::now()->year;

        return 'R-'. $year . '-' . $user. '-' . $id;
    }

    public function getBillAdmin($id)
    {
        return Bill::select('bills.*', 'bills.id AS id', 'users.firstname', 'users.lastname')->join('users', 'bills.user', '=', 'users.id')->where('invoice', '=', $id)->first();
    }

    public function setBillToPaid($id)
    {
        DB::table('bills')->where('id', '=', $id)->update(['open' => 0]);

        $this->invoice->updateInvoice($id);

    }
       
}
