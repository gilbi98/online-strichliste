<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Bill;
use App\Position;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public $invoice;
    public $bill;

    public function __construct()
    {
        $this->invoice = new Invoice;
        $this->bill = new Bill;
        $this->position = new Position;
    }
    
    public function indexInvoices()
    {
        return view('admin.invoices', ['open_invoices' => $this->invoice->getOpenInvoices(), 'closed_invoices' => $this->invoice->getClosedInvoices()]);
    }

    public function indexInvoice($id)
    {
        return view('admin.invoice', ['open_bills' => $this->invoice->getOpenBills($id), 'closed_bills' => $this->invoice->getClosedBills($id)]);
    }

    public function getLastInvoiceInterval()
    {
       return $this->invoice->getLastInvoiceInterval();
    }

    public function getLastInvoiceDate()
    {
       return $this->invoice->getLastInvoiceDate();
    }

    public function create(Request $request)
    {
        // 1. create invoice, 2. create bills, 3. create positions 
        
        $start = $request->input('start');
        $end = $request->input('end');
        if($request->input('term_date') != null){
            $term = $request->input('term_date');
        }
        else{
            $term = Carbon::now()->addDays($request->input('term_days'));
        }
        
        //create invoice only with start and end date
        $this->invoice->createInvoice($start, $end, $term);

        //get ID of created invoice
        $invoiceId = DB::table('invoices')->orderBy('id', 'desc')->value('id');

        //get array with users with open purchases
        $users = $this->bill->getUsersForBills($start, $end);

        //get array with users bill data
        $billData = $this->bill->getBillData($users, $start, $end);
        
        //create bills
        $this->bill->createBills($billData, $invoiceId, $term);

        //update bill based invoice data
        $bills_total = count($billData);
        $bills_open = $bills_total;

        $amount_total = 0;
        for($i=0; $i<count($billData); $i++){
            $amount_total = $amount_total + $billData[$i]['amount'];
        }
        $amount_open = $amount_total;

        DB::table('invoices')->where('id', '=', $invoiceId)->update(['bills_total' => $bills_total, 'bills_open' => $bills_open, 'amount_total' => $amount_total,  'amount_open' => $amount_open]);

        //create bill positions
        $this->position->createPositions($users);

        return redirect()->route('purchases')->with('message', 'Die Entnahmen wurden abgerechnet');
    }
   
}
