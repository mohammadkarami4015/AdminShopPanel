<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Permission;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.index', compact('permissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $role = Role::query()->create($request->only('name', 'label'));

        /** @var Role $role */
        $role->permissions()->sync($request->get('permissions'));

        flash('نقش جدید با موفقیت ثبت شد');

        return redirect(route('role.index'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('role.edit', compact('role', 'permissions'));
    }

    public function update(RoleStoreRequest $request, Role $role)
    {
        $role->update($request->only('name', 'label'));

        $role->permissions()->sync($request->get('permissions'));

        flash('نقش مورد نظر با موفقیت ویرایش شد');

        return redirect(route('role.index'));
    }

    public function delete(Role $role)
    {
        $role->permissions()->delete();
        $role->delete();

        flash('نقش مورد نظر با موفقیت حذف شد');

        return back();
    }
}
