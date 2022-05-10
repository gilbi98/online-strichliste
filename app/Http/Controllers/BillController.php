<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Position;
use App\BillPosition;
use App\Purchase;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use Auth;
use PDF;

class BillController extends Controller
{
    public $bill;
    public $invoice;

    public function __construct()
    {
        $this->bill = new Bill;
        $this->invoice = new Invoice;

        Paginator::useBootstrap();
    }

    public function indexBillsUser()
    {
        return view('user.bills', ['total_positions' => $this->bill->getUsersPositionsAmount(Auth::user()->id), 'open_bills' => $this->bill->getUsersOpenBillsQuantity(Auth::user()->id), 'total_bills' => $this->bill->getUsersOpenBillsAmount(Auth::user()->id), 'purchases' => $this->bill->getUsersPurchasesPaginate(Auth::user()->id, 5), 'bills' => $this->bill->getUsersBillsPaginate(Auth::user()->id, 5), 'last_invoice' => $this->invoice->getLastInvoiceDate()]);
    }

    public function indexBillUser($id)
    {
        return view('user.bill', ['amount' => $this->bill->getBillAmount($id), 'start_date' => $this->bill->getStartDate($id), 'end_date' => $this->bill->getEndDate($id), 'term' => $this->bill->getTerm($id), 'open' => $this->bill->getPaymentStatus($id), 'positions' => $this->bill->getBillPositions($id),]);
    }

    public function indexBillAdmin($id)
    {
        return view('admin.bill', ['bill' => $this->bill->getBillAdmin($id), 'positions' => $this->bill->getBillPositions($id)]);
    }

    public function setBillToPaid($id)
    {
        $this->bill->setBillToPaid($id);

        return redirect()->back();
    }
    
    public function downloadBill($id)
    {
        $pdf = PDF::loadView('/admin/billPdf');

        $rechnungsnr = 1234;
  
        return $pdf->download($rechnungsnr.'.pdf');

    }
}
