<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordRequest;

class AdminController
{
    public function index()
    {
        $admins = Admin::query()->latest()->paginate(20);

        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(AdminRequest $request)
    {
        Admin::query()->create(array_merge(
            ['password' => bcrypt($request->get('password'))],
            $request->only('name', 'last_name', 'phone_number', 'status', 'email')
        ));

        flash('عملیات با موفقیت انجام شد!');
        return redirect()->route('admin.index');
    }

    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->validated());

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

    public function activate($id, $value)
    {
        $admin = Admin::query()->findOrFail($id);
        $admin->update(['status' => $value]);
    }

}
