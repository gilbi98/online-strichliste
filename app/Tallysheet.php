<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tallysheet extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'nickname', 'email', 'password', 'credit', 'role', 'pc1', 'pc2', 'pc3', 'pc4'
    ];
}
