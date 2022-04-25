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

    public function getUsersOpenArticles($user)
    {
        return DB::table('purchases')->where('user', '=', $user)->groupBy('article')->get('article')->toArray();
    }

    public function getUsersOpenPositions($user, $articles)
    {
        $positions = array();

        for($i=0; $i<count($articles); $i++){
            $position[$i] = array();
            $position[$i]['article'] = $articles[$i];
            $position[$i]['quantity'] = (int)DB::table('purchases')->where('article', '=', $articles[$i])->sum('quantity');
            $position[$i]['amount'] = (int)DB::table('purchases')->where('article', '=', $articles[$i])->sum('amount');
        }

        return $positions;
    }

    public function createPositions($users)
    {
        for($i=0; $i<count($users); $i++){
            $articles = DB::table('purchases')->where('user', '=', $users[$i])->groupBy('article')->pluck('article')->toArray();
            $bill = DB::table('bills')->where('user', '=', $users[$i])->orderBy('id', 'desc')->pluck('id')->first();

            for($j=0; $j<count($articles); $j++){

                $article = $articles[$j];
                
                $position = new Position;
                $position->user = $users[$i];
                $position->bill = $bill;
                $position->article = $article;
                $position->quantity = (int)DB::table('purchases')->where('article', '=', $article)->sum('quantity');
                $position->amount = (double)DB::table('purchases')->where('article', '=', $article)->sum('cost');
                $position->save();
                
            }

        }

        return 1;
    }

}
