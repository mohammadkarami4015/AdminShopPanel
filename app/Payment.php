<?php

namespace App;

use App\Http\Requests\CourseSubmitRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    protected $guarded = [];
    use SoftDeletes;


    public function presentCourse()
    {
        return $this->belongsTo(PresentCourse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

}
