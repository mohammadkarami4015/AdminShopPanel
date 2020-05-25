<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Financial;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\FinancialRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class FinancialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function confirm($id)
    {
        $financial=Financial::find($id);
        $financial->status="accepted";
        $financial->save();
        return ['status'=>$financial->status];
    }

    public function index()
    {
        if (Gate::check('teacher')){
            $financials=Financial::where('user_id',auth()->user()->id)->orderBy('id','desc')->paginate(20);
        }elseif (Gate::check('super_admin') || Gate::check('admin')){
            $financials=Financial::orderBy('id','desc')->paginate(20);
        }

        $flag=false;
        return view('financial.index',compact('financials','flag'));
    }


    public function create()
    {
        return view('financial.create');
    }


    public function store(FinancialRequest $request)
    {
        Financial::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('financial.index');
    }

    public function edit($id)
    {
        $financial=Financial::find($id);
        return view('financial.edit',compact('financial'));
    }

    public function update(FinancialRequest $request,$id)
    {
        $financial=Financial::find($id);
        $financial->update($request->only(['amount', 'card_number','sheba']));
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        if ($financial->user->type=="3" || $financial->user->type=="4"){
            return redirect()->route('teacher.myRequest');
        }else{
            return redirect()->route('financial.index');
        }
    }

    public function destroy($id)
    {
        Financial::destroy($id);
        return back();
    }
}
