<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\AdminUpdateRoleRequest;
use App\Role;
use Illuminate\Http\Request;

class AdminController
{
    public function index()
    {
        $admins = Admin::query()->latest()->paginate(20);

        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        $roles =Role::all();

        return view('admin.create',compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $admin = Admin::query()->create(array_merge(
            ['password' => bcrypt($request->get('password'))],
            $request->only('name', 'last_name', 'phone_number', 'status', 'email')
        ));

        /** @var Admin $admin */
        if ($request->get('roles')) {
            $admin->roles()->sync($request->get('roles'));
        }

        flash('عملیات با موفقیت انجام شد!');
        return redirect()->route('admin.index');
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.edit', compact('admin', 'roles'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->except('roles'));

        /** @var Admin $admin */
        if ($request->get('roles')) {
            $admin->roles()->sync($request->get('roles'));
        }

        flash('عملیات با موفقیت انجام شد!');
        return back();
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        flash('عملیات با موفقیت انجام شد!');
        return back();
    }

    public function changePassword(PasswordRequest $request, Admin $admin)
    {
        $admin->update(['password' => bcrypt($request->get('password'))]);
        flash('عملیات با موفقیت انجام شد!');
        return back();
    }

    public function updateRoles(Admin $admin, AdminUpdateRoleRequest $request)
    {
        $admin->roles()->sync($request->get('role_id'));

        flash('عملیات با موفقیت انجام شد!');
        return back();
    }

    public function activate($id, $value)
    {
        $admin = Admin::query()->findOrFail($id);
        $admin->update(['status' => $value]);
    }

    public function search(Request $request)
    {
        $admins = Admin::search($request->get('data'));

        return view('admin.searchResult', compact('admins'));
    }

}
