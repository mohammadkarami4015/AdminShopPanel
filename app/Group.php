<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    public function subGroups()
    {
        return $this->hasMany(Subgroup::class);
    }
}
