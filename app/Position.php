<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'id', 'user', 'article', 'quantity',
    ];

    public $timestamps = false;
}
