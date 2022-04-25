<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Purchase extends Model
{
    protected $fillable = [
        'id', 'user', 'article', 'quantity', 'cost', 'date', 'created_at', 'updated_at'
    ];

    public function getPurchasesByArticles()
    {
        $articles = DB::table('purchases')->groupby('article')->pluck('article')->toArray();

        for($i=0; $i<count($articles); $i++){

            $currentId = $articles[$i];

            $articles[$i] = array();

            $articles[$i]['id'] = $currentId;

            $articles[$i]['name'] = DB::table('articles')->where('id', '=', $currentId)->value('name');

            $articles[$i]['quantity'] = (int)DB::table('purchases')->where(['article' => $currentId])->sum('quantity');

            $articles[$i]['costs'] = DB::table('purchases')->where(['article' => $currentId])->sum('cost');
        }

        return $articles;

    }
}
