<?php

namespace App;

use App\Http\Requests\NewsRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;


    protected $guarded = [];
    protected $table = "articles";


    public static function createNew(NewsRequest $request)
    {
        $news= new News();
        $news->saveAs($request);
        return $news;
    }

    public static function updateInstance(NewsRequest $request ,$id)
    {
        $news= News::find($id);
        $news->saveAs($request);
        return $news;
    }

    public function saveAs($request)
    {
        $this->title = $request->title;
        $this->user_id = $request->user()->id;
        $this->type= "2";
        $this->desc  = $request->desc;
        $this->photo  = $request->file('photo')?makePhotoTypeFile($request->file('photo'),'news'):$this->photo;
        $this->save();
    }
}
