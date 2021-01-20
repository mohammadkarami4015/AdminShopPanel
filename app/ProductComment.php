<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ProductComment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createNew($productComment,$message)
    {
        self::query()->create([
            'shop_id' => $productComment->shop_id,
            'product_id' => $productComment->product_id,
            'user_id' => $productComment->user_id,
            'message' => $message,
            'replay_flag' => $productComment->id,
            'admin_verification' => 'on',
        ]);
    }

    public function child()
    {
        return $this->hasOne(ProductComment::class, 'replay_flag');
    }
}
