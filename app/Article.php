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

    protected $table = 'articles';

    public $timestamps = false;



    public $category;

    public function __construct()
    {
        $this->category = new Category;
    }

    public function getArticles()
    {
        return DB::table('articles')->leftJoin('categories', 'articles.category', 'categories.id')->select('articles.*', 'categories.name AS category_name')->simplePaginate(10);
    }

    public function getArticlesWithTracking()
    {
        return DB::table('articles')->leftJoin('categories', 'articles.category', 'categories.id')->select('articles.*', 'categories.name AS category_name')->where('articles.status', '=', 1)->where('articles.stock_tracking', '=', 1)->get();
    }

    public function getArticlesWithoutTracking()
    {
        return DB::table('articles')->leftJoin('categories', 'articles.category', 'categories.id')->select('articles.*', 'categories.name AS category_name')->where('articles.status', '=', 1)->where('articles.stock_tracking', '=', 0)->get();
    }

    public function getArticle($id)
    {
        return DB::table('articles')->leftJoin('categories', 'articles.category', 'categories.id')->where('articles.id', '=', $id)->select('articles.*', 'categories.name AS category')->first();
    }

    public function getArticlesByCategory($id)
    {
        return DB::table('articles')->leftJoin('categories', 'articles.category', 'categories.id')->where('articles.category', '=', $id)->get();
    }

    public function getInStock($article)
    {
        return DB::table('articles')->where('id', '=', $article)->value('in_stock');
    }

    public function setInStock($article, $quantity)
    {
        DB::table('articles')->where(['id' => $article])->update(['in_stock' => $quantity]);
    }

    public function setOverMin($article, $over_min)
    {
        DB::table('articles')->where(['id' => $article])->update(['over_min' => $over_min]);
    }

    public function updateArticleData($article, $name, $price, $category, $status)
    {
        if($status == null){
            $st = 0;
        }
        else{
            $st = 1;
        }
        
        DB::table('articles')->where('id', '=', $article)->update(['name' => $name, 'price' => $price, 'category' => $category, 'status' => $st]);

        return 1;
    }

    public function updateArticleStockData($article, $in_stock, $min_stock, $stockTracking)
    {
        $over_min = $in_stock - $min_stock;
        
        DB::table('articles')->where(['id' => $article])->update(['in_stock' => $in_stock, 'min_stock' => $min_stock, 'over_min' => $over_min, 'stockTracking' => $stockTracking]);
    }

    public function updateArticlesStock($request)
    {
        $newInStocks = $request->except('_token');

        if(DB::table('categories')->get('id')->count() > 0){
            $articles = DB::table('articles')->where('articles.status', '=', 1)->where('articles.stock_tracking', '=', 1)->where('articles.category', '!=', null)->pluck('id')->toarray();
        }
        else{
            $articles = DB::table('articles')->where('articles.status', '=', 1)->where('articles.stock_tracking', '=', 1)->where('articles.category', '=', null)->pluck('id')->toarray();
        }
        
        for($i=0; $i<count($articles); $i++){

            $currentId = $articles[$i];

            DB::table('articles')->where(['id' => $currentId])->update(['in_stock' => $newInStocks[$currentId] ]);

            $over_min = $newInStocks[$currentId]  - DB::table('articles')->where('id', $currentId)->value('min_stock');
            
            $this->setOverMin($currentId, $over_min);

        }
        
    }

    public function storeArticle($request)
    {
        $stock_tracking = null;
        if($request->input('stockTracking') == null){
            $stock_tracking = 0;
        }
        else{
            $stock_tracking = 1;
        }

        DB::table('articles')->insert([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
            'stock_tracking' => $stock_tracking,
            'in_stock' => $request->input('in_stock'),
            'min_stock' => $request->input('min_stock'),
            'over_min' => $request->input('in_stock')-$request->input('min_stock') 
        ]);

    }

    public function getMinStock($id)
    {
        return DB::table('articles')->where('id', $id)->value('min_stock');
    }
    
       
}
