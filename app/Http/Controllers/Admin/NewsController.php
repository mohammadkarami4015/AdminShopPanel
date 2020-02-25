<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\NewsRequest;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $news=News::find($id);
        $news->status=$value=='on'?$value:"off";
        $news->save();
        return $news->status;
    }

    public function index()
    {
        $newses=News::orderBy('id','desc')->where('type','2')->paginate(20);
        $flag=false;
        return view('news.index',compact('newses','flag'));
    }


    public function create()
    {
        return view('news.create');
    }


    public function store(NewsRequest $request)
    {
        News::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('news.index');
    }

    public function edit($id)
    {
        $news=News::find($id);
        return view('news.edit',compact('news'));
    }

    public function update(NewsRequest $request,$id)
    {
        News::updateInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('news.index');
    }

    public function destroy($id)
    {
        News::destroy($id);
        return back();
    }
}
