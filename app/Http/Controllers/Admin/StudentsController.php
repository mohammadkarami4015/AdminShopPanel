<?php

namespace App\Http\Controllers\Admin;

use App\CourseStudent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }


    public function indexTwo($present_course_id)
    {
        $c_ses=CourseStudent::where('present_course_id',$present_course_id)->orderBy('id','desc')->paginate(20);
        $flag=false;
        return view('student.index',compact('c_ses','flag'));
    }


    public function storeTow($id)
    {
        $c_s=CourseStudent::addNew($id);
        if ($c_s){
            flash()->success('success', 'عملیات با موفقیت انجام شد!');
            return redirect()->route('student.indexTwo',["id"=>$c_s->present_course_id]);
        }else{
            flash()->error('error', 'این دانشجو قبلا به لیست اضافه شده است!');
            return back();
        }
    }

    public function edit($id)
    {
        $c_s=CourseStudent::find($id);
        return view('student.edit',compact('c_s'));
    }

    public function update(Request $request,$id)
    {
        $c_s=CourseStudent::find($id);
        $c_s->update($request->all());
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('student.indexTwo',["id"=>$c_s->present_course_id]);
    }

    public function destroy($id)
    {
        CourseStudent::destroy($id);
        return back();
    }
}
