<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public static function scopeSearch(Builder $query, $statusId, $shopId, $data)
    {
        $query->where('shop_id', $shopId)->where('order_status', $statusId)->get();
//            ->where(function (Builder $query) use ($data) {
//                $query->WhereHas('user', function ($user) use ($data) {
//                    return $user->where('name', 'like', '%' . $data . '%');
//                });
//
//                $query->orWhere('address', 'like', '%' . $data . '%');
//
//                $query->orWhere('total_price', 'like', '%' . $data . '%');
//            });

        dd( $query->get());
    }

}
