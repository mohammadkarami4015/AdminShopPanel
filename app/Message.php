<?php

namespace App;

use App\Http\Requests\MessageRequest;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public static function createNew(MessageRequest $request)
    {
        $message = new Message();
        $message->saveAs($request);
        return $message;
    }

    public function saveAs($request)
    {
        $this->name = $request->name;
        $this->title = $request->title;
        $this->message  = $request->message;
        $this->phone_number  = $request->phone_number;
        $this->save();
    }
}
