<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function profil()
    {
        return view('user.profil', ['cookieStored' => $this->user->checkForCookie(Auth::user()->id),'email' => $this->user->getEmail(Auth::user()->id), 'PinGenerated' => $this->user->checkForPin(Auth::user()->id)]);        
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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Das alte Passwort ist falsch");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Passwort wurde geändert");
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        User::whereId(auth()->user()->id)->update([
            'email' => $request->email
        ]);

        return back()->with("email", "Email wurde geändert");
    }

    public function indexUsers()
    {
        return view('admin.users', ['users' => $this->user->getUsers(), 'usersPayment' => $this->user->getUsersPaymentData()]);
    }
}
