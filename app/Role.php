<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function admin()
    {
        return $this->belongsToMany(User::class);
    }

    public function assignPermission($permissions)
    {
        $this->permissions()->sync($permissions);
    }

    public static function search($value)
    {
        return self::query()->where('name', 'like', '%' . $value . '%')
            ->orWhere('label', 'like', '%' . $value . '%')
            ->orWhereHas('permissions', function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%');
                $query->orWhere('label', 'like', '%' . $value . '%');
                return $query;
            })->latest()->get();
    }
}
