<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ShopCategory extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public static function scopeSearch(Builder $query, $shopId, $data)
    {
        $query->where('shop_id', $shopId)->where(function (Builder $query) use ($data) {
            $query->Where('title', 'like', '%' . $data . '%');

            return $query;
        });
    }


}
