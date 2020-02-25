<?php

namespace App\Http\Controllers\Admin;

use App\Clearing;
use App\Financial;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClearingRequest;
use App\Http\Requests\ResultRequest;
use App\Result;
use App\Test;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $result=Result::find($id);
        $result->status=$value=='on'?$value:'off';
        $result->save();
        return $result->status;
    }

    public function index()
    {
        $results=Result::orderBy('id','desc')->paginate(20);
        $flag=false;
        return view('result.index',compact('results','flag'));
    }


    public function create($id=null)
    {
        $tests=Test::all();
        return view('result.create',compact('tests'));
    }


    public function store(ResultRequest $request)
    {
        Result::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('result.index');
    }

    public function edit($id)
    {
        $result=Result::find($id);
        $tests=Test::all();
        return view('result.edit',compact('result','tests'));
    }

    public function update(ResultRequest $request,$id)
    {
        $result=Result::find($id);
        $result->update($request->only(['title', 'value', 'tip', 'test_id']));
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('result.index');
    }

    public function destroy($id)
    {
        Result::destroy($id);
        return back();
    }
}
