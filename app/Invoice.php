<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Invoice extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'created_from', 'start_date', 'end_date', 'bills_total', 'bills_open', 'amount_open', 'positions'
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

    public function createNewInvoice($start, $end)
    {
        $invoice = new Invoice;
        $invoice->start_date = $start;
        $invoice->end_date = $end;
        $invoice->created_from = Auth::user()->id;
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
}
