<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\CourseStudent;
use App\Http\Requests\Shop\UserRequest;
use App\Http\Requests\Shop\UserUpdateRequest;
use App\Result;
use App\Role;
use App\State;
use App\User;
use App\Http\Controllers\Controller;
use App\UserPost;
use App\UserTest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('can:update', ['only' => ['edit','update']]);
//        $this->middleware('can:delete', ['only' => ['destroy']]);
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
        $users=User::where('type','5')->orderBy('id','desc')->paginate(15);
        $flag=false;
        return view('user.showAll', compact('users','flag'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles=Role::all();
        return view('user.edit', compact('user','roles'));
    }


    public function update(UserUpdateRequest $request, $id)
    {
        $user=User::updateUserInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        if ($user->type=="5"){
            return redirect()->route('user.myProfile');
        }
        return redirect()->route('user.index');
    }


    public function destroy($id)
    {
        User::destroy($id);
        return back();

    }

    public function myProfile(Request $request)
    {
        $user = User::where('id',$request->user()->id)->first();
        $flag=false;
        return view('user.myProfile',compact('user','flag'));
    }

    public function mySubmits(Request $request)
    {
        $user = User::where('id',$request->user()->id)->first();
        $flag=false;
        return view('user.mySubmits',compact('user','flag'));
    }

    public function myCourse(Request $request)
    {
        $user = User::where('id',$request->user()->id)->first();
        $flag=false;
        return view('user.myCourse',compact('user','flag'));
    }

    public function myTest(Request $request)
    {
        $user = User::where('id',$request->user()->id)->first();
        $flag=false;
        return view('user.myTest',compact('user','flag'));
    }

    public function showResult($id)
    {
        $user_test=UserTest::find($id);
        $results = Result::where('test_id',$user_test->test_id)->orderBy('id','desc')->get();
        return view('test.showResult',compact('results','user_test'));
    }

    public function userEducationalStatus(Request $request)
    {
        $courses=Course::all();
        $c_students=CourseStudent::where("user_id",$request->user()->id)->where('status','success')->get();
        return view('user.userEducationalStatus',compact('courses','c_students'));
    }

}
