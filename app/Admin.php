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

    public static function search($value)
    {
        return self::query()->where('name', 'like', '%' . $value . '%')
            ->orWhere('last_name', 'like', '%' . $value . '%')
            ->orWhere('email', 'like', '%' . $value . '%')
            ->orWhere('phone_number', 'like', '%' . $value . '%')
            ->latest()->get();
    }

}
