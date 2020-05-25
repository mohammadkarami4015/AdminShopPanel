<?php

namespace App\Http\Controllers\Admin;

use App\CourseStudent;
use App\Http\Requests\TeacherUpdateRequest;
use App\PresentCourse;
use App\Result;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use App\UserTest;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update', ['only' => ['edit','update']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $user=User::find($id);
        $user->status=$value=='on'?$value:"off";
        $user->save();
        return $user->status;
    }

    public function index()
    {
        $teachers=User::where('type','3')->orderBy('id','desc')->paginate(15);
        $flag=false;
        $title="اولیه";
        return view('teacher.showAll', compact('teachers','flag','title'));
    }

    public function index2()
    {
        $teachers=User::where('type','4')->orderBy('id','desc')->paginate(15);
        $flag=false;
        $title="";
        return view('teacher.showAll', compact('teachers','flag','title'));
    }

    public function edit($id)
    {
        $teacher = User::find($id);
        $roles=Role::all();
        return view('teacher.edit', compact('teacher','roles'));
    }


    public function update(TeacherUpdateRequest $request, $id)
    {
        $teacher= User::updateTeacherInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        if ($teacher->type=="3" || $teacher->type=="4"){
            return redirect()->route('teacher.myProfile');
        }else{
            return redirect()->route('teacher.index1');
        }
    }


    public function destroy($id)
    {
        User::destroy($id);
        return back();

    }


    public function myProfile(Request $request)
    {
        $teacher = User::where('id',$request->user()->id)->first();
        $flag=false;
        return view('teacher.myProfile',compact('teacher','flag'));
    }

    public function myRequest(Request $request)
    {
        $teacher = User::where('id',$request->user()->id)->first();
        $flag=false;
        return view('teacher.myRequest',compact('teacher','flag'));
    }

    public function myCourse(Request $request)
    {
        $teacher = User::where('id',$request->user()->id)->first();
        $flag=false;
        return view('teacher.myCourse',compact('teacher','flag'));
    }

    public function myTest(Request $request)
    {
        $teacher = User::where('id',$request->user()->id)->first();
        $flag=false;
        return view('teacher.myTest',compact('teacher','flag'));
    }

    public function showResult($id)
    {
        $user_test=UserTest::find($id);
        $results = Result::where('test_id',$user_test->test_id)->orderBy('id','desc')->get();
        return view('test.showResult',compact('results','user_test'));
    }

    public function educationalTree(Request $request)
    {
        $p_ces=PresentCourse::where("user_id",$request->user()->id)->get()->pluck("id")->toArray();
        $c_stes=CourseStudent::whereIn("present_course_id",$p_ces)->get()->pluck("user_id")->toArray();
        $users = User::whereIn('id',$c_stes)->orderBy('id','desc')->get();
        return view('teacher.educationalTree',compact('users'));
    }

    public function userEducationalTree($id)
    {
        $p_ces=PresentCourse::where("user_id",$id)->get()->pluck("id")->toArray();
        $c_stes=CourseStudent::whereIn("present_course_id",$p_ces)->get()->pluck("user_id")->toArray();
        $users = User::whereIn('id',$c_stes)->orderBy('id','desc')->get();
        $c_user=User::find($id);
        return view('teacher.userEducationalTree',compact('users','c_user'));
    }


}
