<?php

namespace App\Http\Controllers\Admin;

use App\CourseStudent;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

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
        $payments=Payment::orderBy('id','desc')->paginate(20);
        $flag=false;
        return view('payment.index',compact('payments','flag'));
    }
}
