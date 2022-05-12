<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Position;
use App\BillPosition;
use App\Purchase;
use App\Invoice;
use App\User;
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
        $name = User::select('users.firstname')->join('bills', 'users.id', 'bills.user')->where('bills.id', $id)->get()->first();

        $bill = DB::table('bills')->where('id', $id)->first();

        $start = $this->bill->getStartDate($id);
        $end = $this->bill->getEndDate($id);

        $positions = Position::select('positions.*', 'articles.name AS article', 'articles.price AS price')->join('articles', 'positions.article', 'articles.id')->where('positions.bill', $id)->get();
        
        $pdf = PDF::loadView('/admin/billPdf', ['name' => $name, 'bill' => $bill, 'positions' => $positions, 'start' => $start, 'end' => $end]);

        $rechnungsnr = DB::table('bills')->where('id', $id)->value('number');
  
        return $pdf->download($rechnungsnr.'.pdf');

    }
}
