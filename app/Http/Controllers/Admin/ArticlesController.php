<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $article=Article::find($id);
        $article->status=$value=='on'?$value:'off';
        $article->save();
        return $article->status;
    }

    public function index()
    {
        $articles=Article::orderBy('id','desc')->where('type','1')->paginate(20);
        $flag=false;
        return view('article.index',compact('articles','flag'));
    }


    public function create()
    {
        return view('article.create');
    }


    public function store(ArticleRequest $request)
    {
        Article::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('articles.index');
    }

    public function edit($id)
    {
        $article=Article::find($id);
        return view('article.edit',compact('article'));
    }

    public function update(ArticleRequest $request,$id)
    {
        Article::updateInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('articles.index');
    }

    public function destroy($id)
    {
        Article::destroy($id);
        return back();
    }
}
