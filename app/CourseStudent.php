<?php

namespace App;

use App\Http\Requests\CourseSubmitRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseStudent extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    public function presentCourse()
    {
        return $this->belongsTo(PresentCourse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function addNew($id)
    {
        $c_submit= CourseSubmit::find($id);
        if (! CourseStudent::where('user_id',$c_submit->user_id)->where('present_course_id',$c_submit->present_course_id)->first()){
            $c_student=new CourseStudent();
            $c_student->mark  = null;
            $c_student->time  = $c_submit->time;
            $c_student->user_id  = $c_submit->user_id;
            $c_student->present_course_id  = $c_submit->present_course_id;
            $c_student->save();
            return $c_student;
        }
        return null;

    }

}
