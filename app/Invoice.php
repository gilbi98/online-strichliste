<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Invoice extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'created_by', 'start_date', 'end_date', 'bills_total', 'bills_open', 'amount_open', 'positions'
    ];

    //Invoices (=Abrechnung) creates the bills for all user who got something in a specific timeslot

    public function getLastInvoiceInterval()
    {
        if(DB::table('invoices')->count() == 0){
            return null;
        }

        else{
            $start = DB::table('invoices')->orderBy('id', 'desc')->value('start_date');
            $end = DB::table('invoices')->orderBy('id', 'desc')->value('end_date');

            return date('d.m.Y', strtotime($start)) . ' - ' . date('d.m.Y', strtotime($end));
        }

    }

    public function getLastInvoiceDate()
    {
        if(DB::table('invoices')->count('id') == 0){
            return null;
        }

        else{
            return DB::table('invoices')->orderBy('id', 'desc')->value('created_at');
        }

    }

    public function getOpenInvoices()
    {
        return DB::table('invoices')->where('open', '=', 1)->orderBy('id', 'desc')->get();
    }

    public function getClosedInvoices()
    {
        return DB::table('invoices')->where('open', '=', 0)->orderBy('id', 'desc')->get();
    }

    public function createInvoice($start, $end)
    {
        $invoice = new Invoice;
        $invoice->start_date = $start;
        $invoice->end_date = $end;
        $invoice->created_by = Auth::user()->id;
        $invoice->save();
    }

    public function getOpenBills($id)
    {
        return Bill::select('bills.*', 'users.firstname', 'users.lastname')->join('users', 'bills.user', '=', 'users.id')->where('invoice', '=', $id)->where('open', '=', 1)->get();
    }

    public function getClosedBills($id)
    {
        return Bill::select('bills.*', 'users.firstname', 'users.lastname')->join('users', 'bills.user', '=', 'users.id')->where('invoice', '=', $id)->where('open', '=', 0)->get();
    }

    public function checkForInvoiceClosure($id)
    {
        if(DB::table('invoices')->where('id', $id)->value('bills_open') == 0){
            return true;
        }
        else return false;
    }

    public function updateInvoice($id)
    {
        $amountBill = DB::table('bills')->where('id', $id)->value('amount');

        $invoice = DB::table('bills')->where('id', $id)->value('invoice');

        $openBillsOld = DB::table('invoices')->where('id', $invoice)->value('bills_open');
        $openBillsNew = $openBillsOld - 1;

        $openAmountOld = DB::table('invoices')->where('id', $invoice)->value('amount_open');
        $openAmountNew = $openAmountOld - $amountBill;

        if($openBillsOld == 1){
            $updateInvoice = DB::table('invoices')->where('id', $invoice)->update(['bills_open' => $openBillsNew, 'amount_open' => $openAmountNew, 'open' => 0]);
        }
        if($openBillsOld > 1){
            $updateInvoice = DB::table('invoices')->where('id', $invoice)->update(['bills_open' => $openBillsNew, 'amount_open' => $openAmountNew]);
        }

    }
}
