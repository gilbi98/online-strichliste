<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function profil()
    {
        return view('user.profil', ['cookieStored' => $this->user->checkForCookie(Auth::user()->id), 'PinGenerated' => $this->user->checkForPin(Auth::user()->id)]);        
    }

    public function generatePin()
    {
        //generates PIN
        $pin = $this->user->createPin();

        //creates a cookie on the users smartphone (1 year duration)
        $cookie = Cookie::forget('kiosk');
        $cookie = Cookie::queue('kiosk', $pin, 8760);

        //saves PIN in users table
        $this->user->setSystemCode(Auth::user()->id, $pin);

        return redirect()->back()->with('message', 'Cookie-Pin wurde erfolgreich generiert');
    }
}
