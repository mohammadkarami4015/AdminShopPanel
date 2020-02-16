<?php
namespace App\Http\Controllers\Admin;
use App\Course;
use App\Http\Requests\CourseRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class CoursesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update', ['only' => ['editAdmins','updateAdmin']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $course=Course::find($id);
        $course->status=$value=='on'?$value:null;
        $course->save();
        return $course->status;
    }

    public function index()
    {
        $courses = Course::orderBy('id','desc')->paginate(15);
        $flag=false;
        return view('course.index',compact('courses','flag'));
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(CourseRequest $request)
    {
        Course::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('course.index');
    }

    public function edit($id)
    {
        $course = Course::find($id);
        return view('course.edit',compact('course'));
    }

    public function update(CourseRequest $request, $id)
    {
        Course::updateInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('course.index');
    }

    public function destroy($id)
    {
        $course=Course::find($id);
        if ($course->photo){
            File::delete($course->photo);
        }
        $course->delete();
        return back();
    }

}
