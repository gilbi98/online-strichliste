<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTallysheet extends Model
{
    protected $fillable = [
        'id', 'user', 'tallysheet',
    ];
}
