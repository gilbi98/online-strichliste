<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Article;
use App\FillUp;
use Illuminate\Http\Request;
use DB;
use Auth;

class ArticleController extends Controller
{
    public $article;

    public function __construct()
    {
        $this->article = new Article;
    }

    public function index()
    {
        return view('admin.articles', ['articles' => $this->article->getArticles()]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        
        $article = new Article;
        $article->name = $request->input('name');
        $article->price = $request->input('price');
        $article->category = $request->input('category');
        $article->stock_tracking = $request->input('stockTracking');
        $article->in_stock = $request->input('in_stock');
        $article->min_stock = $request->input('min_stock');
        $article->over_min = $request->input('in_stock') - $request->input('min_stock');
        $article->save();

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
