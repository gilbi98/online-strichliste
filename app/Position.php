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

    //a position sums up how often one article got by an user, thus for each gotten article there is one position

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
        // returns all articles got by an user since last invoice
        return DB::table('purchases')->where('user', '=', $user)->groupBy('article')->pluck('article')->toArray();
    }

    public function getUsersOpenPositions($user, $articles)
    {
        // determines all positions based on the open articles
        $positions = array();

        for($i=0; $i<count($articles); $i++){
            $positions[$i] = array();
            $positions[$i]['name'] = DB::table('articles')->where('id', $articles[$i])->value('name');
            $positions[$i]['quantity'] = (int)DB::table('purchases')->where('article', '=', $articles[$i])->where('user', '=', $user)->sum('quantity');
            $positions[$i]['price'] = DB::table('articles')->where('id', '=', $articles[$i])->value('price');
            $positions[$i]['amount'] = (int)DB::table('purchases')->where('article', '=', $articles[$i])->where('user', '=', $user)->sum('cost');
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
                $position->quantity = (int)DB::table('purchases')->where('article', '=', $article)->where('user', '=', $users[$i])->sum('quantity');
                $position->amount = (double)DB::table('purchases')->where('article', '=', $article)->where('user', '=', $users[$i])->sum('cost');
                $position->save();
                
                //delete purchase
                DB::table('purchases')->where('article', '=', $article)->where('user', $users[$i])->delete();
            }

        }

        return 1;
    }

}
