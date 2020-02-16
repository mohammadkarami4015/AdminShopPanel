<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{

    protected $guarded = [];

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }

    public function addPhoto(Photo $photo)
    {
        return $this->photo()->save($photo);
    }
}
