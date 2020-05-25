<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\PresentCourseRequest;
use App\PresentCourse;
use App\User;
use Illuminate\Support\Facades\Gate;

class PresentCoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $p_c=PresentCourse::find($id);
        $p_c->status=$value=='on'?$value:'off';
        $p_c->save();
        return $p_c->status;
    }

    public function index()
    {
        if (Gate::check('teacher')){
            $p_ces=PresentCourse::where('user_id',auth()->user()->id)->orderBy('id','desc')->paginate(20);
        }elseif (Gate::check('super_admin') || Gate::check('admin') ){
            $p_ces=PresentCourse::orderBy('id','desc')->paginate(20);
        }
        $flag=false;
        return view('present.index',compact('p_ces','flag'));
    }


    public function create()
    {
        $courses=Course::where('status','on')->orderBy('title','asc')->get();
        $teachers=User::where('status','on')->whereIn('type',["3","4"])->orderBy('name','asc')->get();
        return view('present.create',compact('courses','teachers'));
    }


    public function store(PresentCourseRequest $request)
    {
        $p_c=PresentCourse::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        if ($p_c->user->type=="3" || $p_c->user->type=="4"){
            return redirect()->route('teacher.myCourse');
        }else{
            return redirect()->route('present.index');
        }
    }

    public function edit($id)
    {
        $p_c=PresentCourse::find($id);
        $courses=Course::where('status','on')->orderBy('title','asc')->get();
        return view('present.edit',compact('p_c','courses'));
    }

    public function update(PresentCourseRequest $request,$id)
    {
        $p_c=PresentCourse::updateInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        if ($p_c->user->type=="3" || $p_c->user->type=="4"){
            return redirect()->route('teacher.myCourse');
        }else{
            return redirect()->route('present.index');
        }
    }

    public function destroy($id)
    {
        PresentCourse::destroy($id);
        return back();
    }
}
