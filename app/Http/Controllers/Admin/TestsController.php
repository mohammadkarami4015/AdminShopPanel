<?php
namespace App\Http\Controllers\Admin;
use App\Course;
use App\Http\Requests\CourseRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Test;
use Illuminate\Support\Facades\File;


class TestsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update', ['only' => ['editAdmins','updateAdmin']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $test=Test::find($id);
        $test->status=$value=='on'?$value:null;
        $test->save();
        return $test->status;
    }

    public function index()
    {
        $tests = Test::orderBy('id','desc')->paginate(15);
        $flag=false;
        return view('test.index',compact('tests','flag'));
    }

    public function create()
    {
        return view('test.create');
    }

    public function store(TestRequest $request)
    {
        Test::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('test.index');
    }

    public function edit($id)
    {
        $test = Test::find($id);
        return view('test.edit',compact('test'));
    }

    public function update(TestRequest $request, $id)
    {
        Test::updateInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('test.index');
    }

    public function destroy($id)
    {
        $test=Test::find($id);
        if ($test->photo){
            File::delete($test->photo);
        }
        $test->delete();
        return back();
    }

}
