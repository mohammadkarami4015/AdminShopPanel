<?php

namespace App\Http\Controllers\Admin;

use App\Clearing;
use App\Financial;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClearingRequest;

class ClearingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $clearings=Clearing::with('financial')->orderBy('id','desc')->paginate(20);
        $flag=false;
        return view('clearing.index',compact('clearings','flag'));
    }


    public function createTwo($id)
    {
        $financial=Financial::find($id);
        return view('clearing.create',compact('financial'));
    }


    public function store(ClearingRequest $request)
    {
        Clearing::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('clearing.index');
    }

    public function edit($id)
    {
        $clearing=Clearing::find($id);
        return view('clearing.edit',compact('clearing'));
    }

    public function update(ClearingRequest $request,$id)
    {
        $clearing=Clearing::find($id);
        $clearing->update($request->only(['amount', 'type', 'card_number', 'sheba']));
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('clearing.index');
    }

    public function destroy($id)
    {
        Clearing::destroy($id);
        return back();
    }
}
