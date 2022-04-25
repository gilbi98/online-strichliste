<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public $category;
    public $article;

    public function __construct()
    {
        $this->category = new Category;
        $this->article = new Article;
    }

    public function indexCategories()
    {
        return view('admin.categories', ['articles' => $this->category->getArticlesByCategories()]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('categories')->with('message', 'Die Kategorie wurde gespeichert');
    }

}
