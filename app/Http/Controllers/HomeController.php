<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Position;
use App\Invoice;
use App\User;
use App\Article;
use App\Purchase;
use App\Bill;

class HomeController extends Controller
{
    public $position;

    public function __construct()
    {
        $this->position = new Position;
        $this->invoice = new Invoice;
        $this->user = new User;
        $this->purchase = new Purchase;
        $this->article = new Article;
        $this->bill = new Bill;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.home', ['positions' => $this->position->getUsersOpenPositions(Auth::user()->id, $this->position->getUsersOpenArticles(Auth::user()->id)), 'last_invoice' => $this->invoice->getLastInvoiceDate()]);
    }

    public function dashboard()
    {
        return view('admin.dashboard', ['user' => $this->user->getNumberOfUser(), 'articles' => $this->article->getNumberOfArticles(), 'purchases' => $this->purchase->getNumberOfOpenPurchases(), 'purchasesAmount' => $this->purchase->getAmountOfOpenPurchases(), 'openBills' => $this->bill->getNumberOfOpenBills(), 'openBillsAmount' => $this->bill->getAmountOfOpenBills(), 'criticalArticles' => $this->article->getCriticalArticles()]);
    }
}

