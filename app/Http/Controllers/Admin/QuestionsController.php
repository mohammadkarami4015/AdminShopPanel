<?php
namespace App\Http\Controllers\Admin;
use App\Course;
use App\Http\Requests\CourseRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\TestRequest;
use App\Question;
use App\Test;
use Illuminate\Support\Facades\File;


class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update', ['only' => ['editAdmins','updateAdmin']]);
        $this->middleware('can:delete', ['only' => ['destroy']]);
    }

    public function activate($id,$value)
    {
        $question=Question::find($id);
        $question->status=$value=='on'?$value:null;
        $question->save();
        return $question->status;
    }

    public function index2($test_id)
    {
        $questions = Question::where('test_id',$test_id)->orderBy('id','desc')->paginate(15);
        $flag=false;
        $test=Test::find($test_id);
        return view('question.index',compact('questions','flag','test'));
    }

    public function createNew($test_id)
    {
        $test=Test::find($test_id);
        return view('question.create',compact('test'));
    }

    public function store(QuestionRequest $request)
    {
        Question::createNew($request);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('question.index2',['test'=>$request->test_id]);
    }

    public function edit($id)
    {
        $question = Question::find($id);
        return view('question.edit',compact('question'));
    }

    public function update(QuestionRequest $request, $id)
    {
        Question::updateInstance($request,$id);
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('question.index2',['test'=>$request->test_id]);
    }

    public function destroy($id)
    {
        $question=Question::find($id);
        $question->delete();
        return back();
    }

}
