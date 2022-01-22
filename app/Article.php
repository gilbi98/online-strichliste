<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Category;

class Article extends Model
{
    protected $fillable = [
        'id', 'name', 'price', 'category', 'tallysheet',
    ];

    public $timestamps = false;

    public $category;

    public function __construct()
    {
        $this->category = new Category;
    }

    public function getArticles()
    {
        if($this->category->checkForCategories() == true){
            return Article::select('articles.id AS id','articles.name AS name','articles.price AS price','categories.name AS category',)->join('categories', 'articles.category', '=', 'categories.id')->get();
        }
        else{
            return DB::table('articles')->get();
        }
        
    }
       
}
