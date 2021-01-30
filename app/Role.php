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
}
