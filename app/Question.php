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
        $question->saveAsUpdate($request);
        return $question;
    }

    public function saveAs($request)
    {
        $this->type= $request->type;
        $this->number= $request->number;
        if ($request->type=="1"){
            $this->question  = $request->question;
            $this->answers  = implode(";",array_slice($request->answers,0,2));
            $this->values= implode(";",array_slice($request->values,0,2));
            $this->test_id  = $request->test_id;
            $this->save();
        }
        if ($request->type=="2"){
            $this->question  = $request->question;
            $this->answers  = implode(";",array_slice($request->answers,2,4));
            $this->values= implode(";",array_slice($request->values,2,4));
            $this->valuex= implode(";",array_slice($request->valuex,0,4));
            $this->test_id  = $request->test_id;
            $this->save();
        }
        if ($request->type=="3"){
            $this->question  = $request->question;
            $this->answers  = implode(";",array_slice($request->answers,6,5));
            $this->values= implode(";",array_slice($request->values,6,5));
            $this->test_id  = $request->test_id;
            $this->save();
        }
        if ($request->type=="4"){
            $this->question  = $request->question;
            $this->answers  = implode(";",array_slice($request->answers,11,8));
            $this->values= implode(";",array_slice($request->values,11,8));
            $this->test_id  = $request->test_id;
            $this->save();
        }if ($request->type=="5"){
            $this->question  = $request->question;
            $this->answers  = implode(";",array_slice($request->answers,19,4));
            $this->values= implode(";",array_slice($request->values,19,4));
            $this->test_id  = $request->test_id;
            $this->save();
        }
    }


    public function saveAsUpdate($request)
    {
        $this->number= $request->number;
        if ($this->type=="1"){
            $this->question  = $request->question;
            $this->answers  = implode(";",$request->answers);
            $this->values= implode(";",$request->values);
            $this->save();
        }
        if ($this->type=="2"){
            $this->question  = $request->question;
            $this->answers  = implode(";",$request->answers);
            $this->values= implode(";",$request->values);
            $this->valuex= implode(";",$request->valuex);
            $this->save();
        }
        if ($this->type=="3"){
            $this->question  = $request->question;
            $this->answers  = implode(";",$request->answers);
            $this->values= implode(";",$request->values);
            $this->save();
        }
        if ($this->type=="4"){
            $this->question  = $request->question;
            $this->answers  = implode(";",$request->answers);
            $this->values= implode(";",$request->values);
            $this->save();
        }
        if ($this->type=="5"){
            $this->question  = $request->question;
            $this->answers  = implode(";",$request->answers);
            $this->values= implode(";",$request->values);
            $this->save();
        }
    }
}
