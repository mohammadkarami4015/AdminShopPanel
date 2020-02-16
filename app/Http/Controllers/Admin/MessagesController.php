<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\User;
use App\Http\Controllers\Controller;
use App\Message;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update', ['only' => []]);
        $this->middleware('can:delete', ['only' => []]);
    }


    public function read($id)
    {
        $msg=Message::find($id);
        $msg->read_at=Carbon::now();
        $msg->save();
        return ['status'=>true] ;
    }



    public function messages()
    {
        $messages=Message::orderByDesc('id')->paginate(15);
        $flag=false;
        return view('messages.messages',compact('messages','flag'));
    }

}
