<?php

namespace App;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\CourseRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function presentCourses()
    {
        return $this->hasMany(PresentCourse::class);
    }

    public static function createNew(CourseRequest $request)
    {
        $course = new Course();
        $course->saveAs($request);
        return $course;
    }

    public static function updateInstance(CourseRequest $request ,$id)
    {
        $course= Course::find($id);
        $course->saveAs($request);
        return $course;
    }

    public function saveAs($request)
    {
        $this->title = $request->title;
        $this->sub_desc  = $request->sub_desc;
        $this->desc  = $request->desc;
        $this->photo  = $request->file('photo')?makePhotoTypeFile($request->file('photo'),'course'):$this->photo;
        $this->type  = $request->type;
        $this->price  = $request->price;
        $this->save();
    }
}
