<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subgroup extends Model
{
    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public static function search($value)
    {
        return self::query()->where('title', 'like', '%' . $value . '%')
            ->orWhereHas('group', function ($query) use ($value) {
                return $query->where('title', 'like', '%' . $value . '%');
            })->latest()->get();
    }
}
