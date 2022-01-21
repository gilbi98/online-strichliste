<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'id', 'user', 'article', 'quantity',
    ];

    public $timestamps = false;

    public function getUsersPositions($user)
    {
        return Position::select(
            'positions.id',
            'positions.article',
            'positions.quantity',
            'positions.amount',
            'articles.name',
            'articles.price',
        )
        ->join('articles', 'positions.article', '=', 'articles.id')
        ->where('user', $user)
        ->get();
    }

}
