<?php

namespace App;

use App\Http\Requests\ArticleRequest;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];


    public static function createNew(ArticleRequest $request)
    {
        $article = new Article();
        $article->saveAs($request);
        return $article;
    }

    public static function updateInstance(ArticleRequest $request ,$id)
    {
        $article = Article::find($id);
        $article->saveAs($request);
        return $article;
    }

    public function saveAs($request)
    {
        $this->title = $request->title;
        $this->user_id = $request->user()->id;
        $this->type= "1";
        $this->desc  = $request->desc;
        $this->photo  = $request->file('photo')?makePhotoTypeFile($request->file('photo'),'article'):$this->photo;
        $this->save();
    }
}
