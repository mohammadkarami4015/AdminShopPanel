<?php

namespace App;

use App\Http\Requests\QuestionRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public static function createNew(QuestionRequest $request)
    {
        $question = new Question();
        $question->saveAs($request);
        return $question;
    }

    public static function updateInstance(QuestionRequest $request ,$id)
    {
        $question= Question::find($id);
        $question->saveAs($request);
        return $question;
    }

    public function saveAs($request)
    {
        $this->title = $request->title;
        $this->question  = $request->question;
        $this->answer1  = $request->answer1;
        $this->answer2  = $request->answer2;
        $this->answer3  = $request->answer3;
        $this->answer4  = $request->answer4;
        $this->test_id  = $request->test_id;
        $this->save();
    }
}
