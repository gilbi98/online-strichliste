<?php

namespace App\Http\Livewire;

use Models\Category;
use Models\Article;
use Livewire\Component;
use DB;

class CategoryArticle extends Component
{
    public $articles = null;
    public $category = null;

    public $selectedCategory = null;

    public function render()
    {
        return view('livewire.category-article', ['categories' => DB::table('categories')->get()]);
    }

    public function updatedSelectedCategory($category)
    {
        if(!is_null($category)) {
            $this->articles = DB::table('articles')->where('category', $category)->get();
        }
    }

}
