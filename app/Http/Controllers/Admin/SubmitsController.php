<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\CourseSubmit;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseSubmitRequest;
use App\Http\Requests\PresentCourseRequest;
use App\PresentCourse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubmitsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $c_s=CourseSubmit::find($id);
        $c_s->payment=$value=='on'?"success":null;
        $c_s->save();
        return $c_s->payment;
    }

    public function index2($present_course_id)
    {
        $c_ses=CourseSubmit::where('present_course_id',$present_course_id)->orderBy('id','desc')->paginate(20);
        $flag=false;
        return view('submit.index',compact('c_ses','flag'));
    }


    public function edit($id)
    {
        $c_s=CourseSubmit::find($id);
        return view('submit.edit',compact('c_s'));
    }

    public function update(Request $request,$id)
    {
        $c_s=CourseSubmit::find($id);
        $c_s->update($request->all());
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('submit.index2',["id"=>$c_s->present_course_id]);
    }

    public function destroy($id)
    {
        CourseSubmit::destroy($id);
        return back();
    }
}
