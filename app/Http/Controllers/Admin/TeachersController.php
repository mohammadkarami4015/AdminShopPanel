<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeacherUpdateRequest;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;

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
        $user->status=$value=='on'?$value:null;
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
        if ($teacher->type=="3"){
            return redirect()->route('teacher.index');
        }else{
            return redirect()->route('teacher.index2');
        }
    }


    public function destroy($id)
    {
        User::destroy($id);
        return back();

    }

}
