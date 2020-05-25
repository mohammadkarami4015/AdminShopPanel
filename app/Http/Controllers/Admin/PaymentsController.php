<?php

namespace App\Http\Controllers\Admin;

use App\CourseStudent;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:add', ['only' => ['create','store']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }


    public function index()
    {

        if (Gate::check('teacher') || Gate::check('student')){
            $payments=Payment::where('user_id',auth()->user()->id)->orderBy('id','desc')->paginate(20);
        }elseif (Gate::check('super_admin') || Gate::check('admin') ){
            $payments=Payment::orderBy('id','desc')->paginate(20);
        }
        $flag=false;
        return view('payment.index',compact('payments','flag'));
    }
}
