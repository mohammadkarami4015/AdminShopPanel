<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public static function createNew($title, $sent_message, $shop_id, $receiver_id, $type)
    {
        $message = new Message();
        $message->saveAs($title, $sent_message, $shop_id, $receiver_id, $type);
        return $message;
    }

    public function saveAs($title, $sent_message, $shop_id, $receiver_id, $type)
    {
        $this->title = $title;
        $this->message = $sent_message;
        $this->user_id = $receiver_id;
        $this->type = $type;
        $this->shop_id = $shop_id;
        $this->save();
    }

}
