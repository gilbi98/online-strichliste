<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'created_from', 'start_date', 'end_date', 'bills_total', 'bills_open', 'amount_open', 'positions'
    ];
}
