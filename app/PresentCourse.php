<?php

namespace App;

use App\Http\Requests\PresentCourseRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresentCourse extends Model
{
    use SoftDeletes;


    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseSubmits()
    {
        return $this->hasMany(CourseSubmit::class);
    }

    public function courseStudents()
    {
        return $this->hasMany(CourseStudent::class);
    }

    public static function createNew(PresentCourseRequest $request)
    {
        $p_c= new PresentCourse();
        $p_c->saveAs($request);
        return $p_c;
    }

    public function saveAs($request)
    {
        $this->user_id = $request->user_id;
        $this->course_id= $request->course_id;
        $this->desc = $request->desc;
        $this->times  = implode(';',array_filter($request->times));
        $this->capacity= $request->capacity;
        $this->submit_date= $request->submit_date;
        $this->start_date= $request->start_date;
        $this->address= $request->address;
        $this->save();
    }

    public static function updateInstance(PresentCourseRequest $request ,$id)
    {
        $p_c = PresentCourse::find($id);
        $p_c->saveAsForUpdate($request);
        return $p_c;
    }

    public function saveAsForUpdate($request)
    {
        $this->course_id= $request->course_id;
        $this->desc = $request->desc;
        $this->times  = implode(';',array_filter($request->times));
        $this->capacity= $request->capacity;
        $this->submit_date= $request->submit_date;
        $this->start_date= $request->start_date;
        $this->address= $request->address;
        $this->save();
    }
}
