<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Position;
use App\Invoice;

class HomeController extends Controller
{
    public $position;

    public function __construct()
    {
        $this->position = new Position;
        $this->invoice = new Invoice;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.home', ['positions' => $this->position->getUsersOpenPositions(Auth::user()->id, $this->position->getUsersOpenArticles(Auth::user()->id)), 'last_invoice' => $this->invoice->getLastInvoiceDate()]);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}

