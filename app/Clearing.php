<?php

namespace App;

use App\Http\Requests\ClearingRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clearing extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected  $table="teacher_payments";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function financial()
    {
        return $this->belongsTo(Financial::class,'payment_request_id');
    }

    public static function createNew(ClearingRequest $request)
    {
        $clearing = new Clearing();
        $clearing->saveAs($request);
        return $clearing;
    }

    public function saveAs($request)
    {
        $this->user_id = $request->user()->id;
        $this->amount = $request->amount;
        if ($request->type=="1"){
            $this->sheba = $request->sheba;
        }
        if ($request->type=="2"){
            $this->card_number = $request->card_number;
        }
        $this->payment_request_id  = $request->payment_request_id;
        $this->type  = $request->type;
        $this->save();
    }
}
