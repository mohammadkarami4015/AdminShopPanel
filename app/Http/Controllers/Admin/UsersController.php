<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\State;
use App\User;
use App\Http\Controllers\Controller;
use App\UserPost;
use Carbon\Carbon;

class UsersController extends Controller
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
        User::updateUserInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('user.index');
    }


    public function destroy($id)
    {
        User::destroy($id);
        return back();

    }

}
