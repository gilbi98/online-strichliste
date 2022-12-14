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
        'id', 'created_at', 'updated_at', 'number', 'term', 'user', 'amount', 'total', 'invoice', 'payment_method', 'payment_date', 'payment_entry_by'
    ];

    public $timestamps = true;

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

    public function getUsersPurchasesAmount($user)
    {
        $amount = 0;

        $amount = DB::table('purchases')->where('user', $user)->sum('cost');

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
        return Purchase::select('purchases.created_at AS date','purchases.quantity AS quantity', 'purchases.cost', 'articles.name','articles.price',)->join('articles', 'purchases.article', '=', 'articles.id')->where('user', Auth::user()->id)->orderBy('purchases.id', 'desc')->SimplePaginate(5);
    }
        
    public function getUsersBillsPaginate($user, $paginate)
    {
        return  DB::table('bills')->where('user',  $user)->orderBy('id', 'desc')->SimplePaginate(5);
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

    public function createBills($billData, $invoice, $term)
    {
        //$invoice = DB::table('invoices')->orderBy('id', 'desc')->value('id');
        
        for($i=0; $i<count($billData); $i++){

            DB::table('bills')->insert([
                'number' => $this->generateBillNumber($invoice, $billData[$i]['user']),
                'created_at' => Carbon::now(),
                'term' => $term,
                'user' => $billData[$i]['user'],
                'amount' => $billData[$i]['amount'],
                'total' => $billData[$i]['amount'],
                'invoice' => $invoice,
                'open' => 1
            ]);

        }
    }

    public function generateBillNumber($id, $user)
    {
        $year = Carbon::now()->year;

        return 'R-'. $year . '-' . $user. '-' . $id;
    }

    public function getBillAdmin($id)
    {
        return Bill::select('bills.*', 'bills.id AS id', 'users.firstname', 'users.lastname')->join('users', 'bills.user', '=', 'users.id')->where('bills.id', '=', $id)->first();
        //->join('users', 'bills.user', '=', 'users.id')
    }

    public function setBillToPaid($request, $id)
    {
        DB::table('bills')->where('id', '=', $id)->update(['open' => 0, 'payment_method' => $request->method, 'payment_date' => Carbon::now(), 'payment_entry_by' => Auth::user()->id]);

        $this->invoice->updateInvoice($id);

    }
       
    public function getNumberOfOpenBills()
    {
        return DB::table('bills')->where('open', 1)->count('id');
    }

    public function getAmountOfOpenBills()
    {
        return DB::table('bills')->where('open', 1)->sum('total');
    }
}
