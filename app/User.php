<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cookie;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname', 'lastname', 'nickname', 'email', 'password', 'credit', 'role', 'pc1', 'pc2', 'pc3', 'pc4'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generatePin($id)
    {
        $code = $this->createPin();

        $this->setSystemCode($id, $code);

        return $code;
    }

    public function setSystemCode($id, $pin)
    {
        DB::table('users')->where('id', $id)->update(['sc' => $pin]);
    }

    public function createPin(){

        $code = random_int(1000, 999999);

        if($this->checkIfSystemCodeExists($code) == true){
            $this->createPin();
        }
        else{
            return $code;
        }
    }

    private function checkIfSystemCodeExists($code)
    {
        if(DB::table('users')->where('sc', $code)->exists()){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkForPin($id)
    {
        if(DB::table('users')->where('id', $id)->value('sc') != null){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkForCookie($id)
    {
        if(Cookie::get('kiosk') == null){
            return 0;
        }else{
            return 1;
        }
    }

    public function checkCookiePin($id, $cookie)
    {
        if($cookie == DB::table('users')->where('id', $id)->value('sc')){
            return true;
        }
        else{
            return false;
        }
    }
}
