<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'id', 'user', 'article', 'quantity', 'created_at', 'updated_at',
    ];
}