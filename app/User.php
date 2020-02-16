<?php

namespace App;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function hasRole($role)
    {
        if (is_string($role)){
            return $this->roles()->contains('name',$role);
        }
        return !! $role->intersect($this->roles)->count();
    }
    /*******************************************************************/

    public static function createNew(AdminRequest $request)
    {
        $admin = new User();
        $admin->saveAs($request);
        foreach ($admin->roles as $role){
            $admin->roles()->detach($role->id);
        }
        $admin->roles()->attach($request->role);
        return $admin;
    }


    public function saveAs($request)
    {
        $this->name       = $request->name;
        $this->phone_number       = $request->phone_number;
        $this->email       = $request->email;
        $this->type       = $request->type;
        $this->about_me= $request->about_me;
        $this->level= $request->level;
        $this->card_number= $request->card_number;
        $this->sheba= $request->sheba;
        $this->national_id= $request->national_id;
        if ($request->password){
            $this->password       = bcrypt($request->password);
        }
        $this->save();
    }

    public static function updateInstance(AdminUpdateRequest $request ,$id)
    {
        $admin = User::find($id);
        $admin->saveAsForUpdate($request);
        foreach ($admin->roles as $role){
            $admin->roles()->detach($role->id);
        }
        $admin->roles()->attach($request->role);
        return $admin;
    }

    public function saveAsForUpdate($request)
    {
        $this->name       = $request->name;
        $this->phone_number       = $request->phone_number;
        $this->email       = $request->email;
        $this->type       = $request->type;
        $this->about_me= $request->about_me;
        $this->level= $request->level;
        $this->card_number= $request->card_number;
        $this->sheba= $request->sheba;
        $this->national_id= $request->national_id;
        if ($request->password){
            $this->password       = bcrypt($request->password);
        }
        $this->save();
    }

    public static function updateUserInstance(UserUpdateRequest $request ,$id)
    {
        $user = User::find($id);
        $user->saveAsForUpdate($request);
        foreach ($user->roles as $role){
            $user->roles()->detach($role->id);
        }
        $user->roles()->attach($request->role);
        return $user;
    }

    public function saveAsForUserUpdate($request)
    {
        $this->name       = $request->name;
        $this->phone_number       = $request->phone_number;
        $this->email       = $request->email;
        $this->type       = $request->type;
        $this->about_me= $request->about_me;
        $this->level= $request->level;
        $this->card_number= $request->card_number;
        $this->sheba= $request->sheba;
        $this->national_id= $request->national_id;
        if ($request->password){
            $this->password       = bcrypt($request->password);
        }
        $this->save();
    }

    public static function updateTeacherInstance(TeacherUpdateRequest $request ,$id)
    {
        $teacher = User::find($id);
        $teacher->saveAsForUpdate($request);
        foreach ($teacher->roles as $role){
            $teacher->roles()->detach($role->id);
        }
        $teacher->roles()->attach($request->role);
        return $teacher;
    }

    public function saveAsForTeacherUpdate($request)
    {
        $this->name       = $request->name;
        $this->phone_number       = $request->phone_number;
        $this->email       = $request->email;
        $this->type       = $request->type;
        $this->about_me= $request->about_me;
        $this->level= $request->level;
        $this->card_number= $request->card_number;
        $this->sheba= $request->sheba;
        $this->national_id= $request->national_id;
        if ($request->password){
            $this->password       = bcrypt($request->password);
        }
        $this->save();
    }

}
