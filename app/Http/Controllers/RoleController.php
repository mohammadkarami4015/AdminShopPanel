<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()->latest()->paginate(20);
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::query()->create($request->only('name', 'label'));

        /** @var Role $role */
        if ($request->get('permissions'))
            $role->permissions()->sync($request->get('permissions'));

        flash('نقش جدید با موفقیت ثبت شد');

        return redirect(route('role.index'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('role.edit', compact('role', 'permissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->only('name', 'label'));

        $role->permissions()->sync($request->get('permissions'));

        flash('نقش مورد نظر با موفقیت ویرایش شد');

        return redirect(route('role.index'));
    }

    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();

        flash('نقش مورد نظر با موفقیت حذف شد');

        return back();
    }

    public function search(Request $request)
    {
        $roles = Role::search($request->get('data'));

        return view('role.searchResult', compact('roles'));
    }

}
