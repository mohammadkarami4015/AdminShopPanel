<?php

namespace App;

use App\Http\Requests\ClearingRequest;
use App\Http\Requests\ResultRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected  $table="test_results";

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public static function createNew(ResultRequest $request)
    {
        $result = new Result();
        $result->saveAs($request);
        return $result;
    }

    public function saveAs($request)
    {
        $this->test_id = $request->test_id;
        $this->title  = $request->title;
        $this->value  = $request->value;
        $this->tip  = $request->tip;
        $this->save();
    }
}
