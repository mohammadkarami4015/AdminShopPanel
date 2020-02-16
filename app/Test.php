<?php

namespace App;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\TestRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public static function createNew(TestRequest $request)
    {
        $test = new Test();
        $test->saveAs($request);
        return $test;
    }

    public static function updateInstance(TestRequest $request ,$id)
    {
        $test= Test::find($id);
        $test->saveAs($request);
        return $test;
    }

    public function saveAs($request)
    {
        $this->title = $request->title;
        $this->desc  = $request->desc;
        $this->photo  = $request->file('photo')?makePhotoTypeFile($request->file('photo'),'test'):$this->photo;
        $this->type  = $request->type;
        $this->price  = $request->price;
        $this->save();
    }
}