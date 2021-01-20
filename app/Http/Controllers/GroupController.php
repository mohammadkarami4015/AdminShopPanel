<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;

class GroupController
{
    public function index()
    {
        $groups = Group::query()->latest()->paginate(20);
        return view('group.index', compact('groups'));
    }


    public function create()
    {
        return view('group.create');
    }


    public function store(GroupRequest $request)
    {
        Group::query()->create($request->validated());

        flash('گروه جدید با موفقیت ثبت شد');

        return redirect(route('group.index'));
    }

    public function edit(Group $group)
    {
        return view('group.edit', compact('group'));
    }


    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        flash('گروه مورد نظر با موفقیت ویرایش شد');

        return redirect(route('group.index'));
    }

    public function destroy(Group $group)
    {
        $group->delete();

        flash('گروه مورد نظر با موفقیت  حذف شد');

        return back();
    }

    public function search(Request $request)
    {
        $groups = Group::query()->where('title', 'like', '%' . $request->get('data') . '%')->latest()->get();

        return view('group.searchResult', compact('groups'));
    }

    public function activate($id, $value)
    {
        $shop = Group::query()->findOrFail($id);
        $shop->update(['status' => $value]);
    }

}
