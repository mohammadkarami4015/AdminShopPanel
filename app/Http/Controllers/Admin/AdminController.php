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

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update', ['only' => ['editAdmins','updateAdmin']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $admin=User::find($id);
        $admin->status=$value=='on'?$value:'off';
        $admin->save();
        return $admin->status;
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $admins = User::whereIn('type',['1','2'])->orderBy('id','desc')->paginate(15);
        $flag=false;
        return view('admin.index',compact('admins','flag'));
    }

    public function create()
    {
        $roles=Role::all();
        return view('admin.create',compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $admin=User::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        if ($admin->type=="1"){
            return redirect()->route('admin.index');
        }if ($admin->type=="3"){
            return redirect()->route('teacher.index');
        }if ($admin->type=="4"){
            return redirect()->route('teacher.index2');
        }if ($admin->type=="5"){
            return redirect()->route('user.index');
        }
        return redirect()->route('admin.index');
    }

    public function editAdmins($id)
    {
        $admin = User::find($id);
        $roles=Role::all();
        return view('admin.editAdmin',compact('admin','roles'));
    }

    public function updateAdmin(AdminUpdateRequest $request, $id)
    {
        User::updateInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back();
    }

}
