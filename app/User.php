<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Collection;

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

    public function getEmail($id)
    {
        return DB::table('users')->where('id', $id)->value('email');
    }

    public function getUsers()
    {
        return DB::table('users')->simplePaginate(10);
    }

    public function getNumberOfUser()
    {
        return DB::table('users')->count('id');
    }

    public function getUsersPaymentData()
    {
        $usersId = DB::table('users')->pluck('id')->toArray();

        $usersPayment = array();

        for($i=0; $i<count($usersId); $i++){

            $usersPayment[$i] = array();

            $usersPayment[$i]['id'] = $usersId[$i];
            $usersPayment[$i]['open_bills'] = DB::table('bills')->where('user', $usersId[$i])->where('open', 1)->count('id');
            $usersPayment[$i]['open_bills_amount'] = DB::table('bills')->where('user', $usersId[$i])->where('open', 1)->sum('total');
            $usersPayment[$i]['purchases'] = DB::table('purchases')->where('user', $usersId[$i])->sum('cost');
        }

        return $usersPayment;
    }

    public function setRole($id, $newRole)
    {
        DB::table('users')->where('id', $id)->update(['role' => $newRole]);
    }

    public function getCriticalUser()
    {
        return User::select('users.firstname', 'users.lastname')->join('bills', 'user.id', 'bill.user')->where('users.role' == 1)->get();
    }

}
