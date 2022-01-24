<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Category;

class Article extends Model
{
    protected $fillable = [
        'id', 'name', 'price', 'category', 'tallysheet', 'stock_tracking'
    ];

    public $timestamps = false;

    public $category;

    public function __construct()
    {
        $this->category = new Category;
    }

    public function getArticles()
    {
        return DB::table('articles')->leftJoin('categories', 'articles.category', 'categories.id')->select('articles.*', 'categories.name AS category')->get();
    }

    public function getInStock($article)
    {
        return DB::table('articles')->where('id', '=', $article)->value('in_stock');
    }

    public function setInStock($article, $quantity)
    {
        DB::table('articles')->where(['id' => $article])->update(['in_stock' => $quantity]);

        return 1;
    }

    
       
}
