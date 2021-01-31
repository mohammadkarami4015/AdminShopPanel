<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role');
    }

}
