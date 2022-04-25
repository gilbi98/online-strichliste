<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Invoice extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'created_from', 'start_date', 'end_date', 'bills_total', 'bills_open', 'amount_open', 'positions'
    ];

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
        if(DB::table('invoices')->count() == 0){
            return null;
        }

        else{
            return DB::table('invoices')->orderBy('id', 'desc')->value('created_at');
        }

    }

    public function createNewInvoice($start, $end)
    {
        $invoice = new Invoice;
        $invoice->start_date = $start;
        $invoice->end_date = $end;
        $invoice->save();
    }
}
