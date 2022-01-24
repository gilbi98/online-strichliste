<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Position;
use App\BillPosition;
use App\Purchase;
use Illuminate\Http\Request;
use DB;
use Auth;

class BillController extends Controller
{
    public $bill;

    public function __construct()
    {
        $this->bill = new Bill;
    }

    public function bills_index()
    {
        return view('user.bills', ['total_positions' => $this->bill->getUsersPositionsAmount(Auth::user()->id), 'open_bills' => $this->bill->getUsersOpenBillsQuantity(Auth::user()->id), 'total_bills' => $this->bill->getUsersOpenBillsAmount(Auth::user()->id), 'purchases' => $this->bill->getUsersPurchasesPaginate(Auth::user()->id, 5), 'bills' => $this->bill->getUsersBillsPaginate(Auth::user()->id, 5)]);
    }

    public function bill_index($id)
    {
        return view('user.bill', ['amount' => $this->bill->getBillAmount($id), 'start_date' => $this->bill->getStartDate($id), 'end_date' => $this->bill->getEndDate($id), 'term' => $this->bill->getTerm($id), 'open' => $this->bill->getPaymentStatus($id), 'positions' => $this->bill->getBillPositions($id),]);
    }
    
}
