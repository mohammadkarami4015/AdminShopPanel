<?php

namespace App;

use App\Http\Requests\FinancialRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financial extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected  $table="payment_requests";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clearings()
    {
        return $this->hasMany(Clearing::class);
    }


    public static function createNew(FinancialRequest $request)
    {
        $financial = new Financial();
        $financial->saveAs($request);
        return $financial;
    }

    public function saveAs($request)
    {
        $this->user_id = $request->user()->id;
        $this->amount = $request->amount;
        $this->card_number  = $request->card_number;
        $this->sheba  = $request->sheba;
        $this->save();
    }
}
