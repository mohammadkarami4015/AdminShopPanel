<?php

namespace App;

use App\Http\Requests\CourseSubmitRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSubmit extends Model
{
    use SoftDeletes;


    protected $guarded = [];

    public function presentCourse()
    {
        return $this->belongsTo(PresentCourse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
