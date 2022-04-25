<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Article;

class Category extends Model
{
    protected $fillable = [
        'id', 'name', 'tallysheet'
    ];

    protected $table = 'categories';

    public $timestamps = false;


    public function checkForCategories()
    {
        if(DB::table('categories')->count('id') > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function getCategories()
    {
        return DB::table('categories')->get();
    }

    public function getCategoriesWithArticles()
    {
        return DB::table('categories')->get();
    }

    public function getArticlesByCategories()
    {
        /* returns following array: categoryID, name, Array of articles for each categoryID, list of categoryNames for each categoryId */
        
        $categories = DB::table('categories')->pluck('id')->toArray();

        $articles = null;

        if(count($categories) == 0){
            return null;
        }

        for($i=0; $i<count($categories); $i++){
           
            $articles[$i]['category'] = $categories[$i];

            $articles[$i]['name'] = DB::table('categories')->where('id', '=', $categories[$i])->value('name');

            $articles[$i]['articlesArray'] = DB::table('articles')->where('category', '=', $categories[$i])->pluck('name')->toArray();

            $articles[$i]['articlesList'] = null;

            for($j=0; $j<count($articles[$i]['articlesArray']); $j++){

                if($j == 0){
                    $articles[$i]['articlesList'] = $articles[$i]['articlesArray'][$j];
                }

                if($j > 0 && $j < count($articles[$i]['articlesArray'])){
                    $articles[$i]['articlesList'] = $articles[$i]['articlesList'] . ', ' . $articles[$i]['articlesArray'][$j];
                }

                if($j == count($articles[$i]['articlesArray'])){
                    $articles[$i]['articlesList'] = $articles[$i]['articlesList'] . ' ' . $articles[$i]['articlesArray'][$j];
                }
            }
        }
        return $articles;
    }

}
