<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Article;
use App\Category;
use App\FillUp;
use Illuminate\Http\Request;
use DB;
use Auth;

class ArticleController extends Controller
{
    public $article;
    public $category;

    public function __construct()
    {
        $this->article = new Article;
        $this->category = new Category;
    }

    public function indexArticles()
    {
        return view('admin.articles', ['articles' => $this->article->getArticles(), 'categories' => $this->category->getCategories(), 'articlesWithTracking' => $this->article->getArticlesWithTracking()]);
    }

    public function indexArticlesWithTracking()
    {
        return view('admin.articles', ['articles' => $this->article->getArticlesWithTracking(), 'categories' => $this->category->getCategories()]);
    }

    public function indexArticlesWithoutTracking()
    {
        return view('admin.articles', ['articles' => $this->article->getArticlesWithoutTracking(), 'categories' => $this->category->getCategories()]);
    }

    public function indexArticle($id)
    {
        return view('admin.article', ['article' => $this->article->getArticle($id), 'categories' => $this->category->getCategories()]);
    }

    public function indexStock()
    {
        return view('admin.stock', ['articles' => $this->article->getArticlesWithTracking(), 'categories' => $this->category->getCategories()]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
        ]);

        $article = new Article;
        $article->name = $request->input('name');
        $article->price = $request->input('price');
        $article->category = $request->input('category');

        if($request->input('stockTracking') == null){
            $article->stock_tracking = 0;
        }
        else{
            $article->stock_tracking = $request->input('stockTracking');
        }

        $article->in_stock = $request->input('in_stock');
        $article->min_stock = $request->input('min_stock');
        $article->over_min = $request->input('in_stock') - $request->input('min_stock');
        $article->save();

        //return $request->input('category');
        return redirect()->route('articles')->with('message', 'Der Artikel wurde gespeichert');
    }

    public function refill(Request $request)
    {
        $quantity_new = $this->article->getInStock($request->input('article')) + $request->input('quantity');

        if($this->article->setInStock($request->input('article'), $quantity_new)){
            return redirect()->route('articles')->with('message', 'Die Auffüllung wurde eingetragen');
        }
        else{
            return redirect()->route('articles')->with('message', 'Es ist ein Fehler aufgetreten');
        }
    }

    public function updateArticleData(Request $request, $id)
    {   
        $this->article->updateArticleData($id, $request->input('name'), $request->input('price'), $request->input('category'), $request->input('status'));
        
        return redirect()->route('article', $id)->with('message', 'Die Stammdaten wurden geändert');
    }

    public function updateArticleStockData(Request $request, $id)
    {
        if($request->stockTracking == null){
            $st = 0;
        }
        else{
            $st = 1;
        }

        DB::table('articles')->where(['id' => $id])->update(['in_stock' => $request->input('in_stock'), 'min_stock' => $request->input('min_stock'), 'stock_tracking' => $st]);

        return redirect()->route('article', $id)->with('message', 'Die Bestandsdaten wurden geändert');
    }
    
    public function updateArticlesStock(Request $request)
    {
        $this->article->updateArticlesStock($request);

        return redirect()->back()->with('message', 'Die Bestandsdaten wurden erfolgreich eingetragen');
        
    }
    
}
