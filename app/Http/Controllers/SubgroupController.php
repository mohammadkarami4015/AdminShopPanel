<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\SubgroupRequest;
use App\Subgroup;

class SubgroupController
{
    public function index()
    {
        $subgroups = Subgroup::query()->latest()->paginate(20);

        return view('subgroup.index', compact('subgroups'));
    }

    public function create()
    {
        $groups = Group::query()->where('status', 'on')->get();

        return view('subgroup.create', compact('groups'));
    }

    public function store(SubgroupRequest $request)
    {
        Subgroup::query()->create($request->validated());

        flash('زیرگروه جدید با موفقیت ثبت شد');

        return redirect(route('subgroup.index'));
    }

    public function edit(Subgroup $subgroup)
    {
        $groups = Group::query()->where('status', 'on')->get();

        return view('subgroup.edit', compact('subgroup','groups'));
    }

    public function update(SubGroupRequest $request, Subgroup $subgroup)
    {
        $subgroup->update($request->validated());

        flash('زیرگروه مورد نظر با موفقیت ویرایش شد');

        return redirect(route('subgroup.index'));
    }

    public function destroy(Subgroup $subgroup)
    {
        $subgroup->delete();

        flash('زیرگروه مورد نظر با موفقیت  حذف شد');

        return back();
    }
}
