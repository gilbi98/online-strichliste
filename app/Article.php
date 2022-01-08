<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id', 'name', 'price', 'category', 'tallysheet',
    ];

    public $timestamps = false;
}
