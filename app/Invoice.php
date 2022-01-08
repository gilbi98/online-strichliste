<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'number', 'term', 'user', 'amount', 'total', 'invoice',
    ];
}
