<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
