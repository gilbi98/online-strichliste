<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FillUp extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'article', 'user', 'quantity',
    ];

    public function create($user, $article, $quantity)
    {
        $fillUp = new FillUp;
        $fillUp->article = $article;
        $fillUp->user = $user;
        $fillUp->quantity= $quantity;
        $fillUp->save();
    }
}
