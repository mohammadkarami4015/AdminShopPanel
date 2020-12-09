<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\Shop\MessageRequest;
use App\Message;
use App\Shop;

class MessageController
{
    public function index(Shop $shop)
    {
        $messages = Message::query()->where('shop_id', $shop->id)->latest()->paginate();

        return view('shops.message.index', compact('messages', 'shop'));
    }

    public function create(Shop $shop)
    {
        return view('shops.message.create', compact('shop'));
    }

    public function store(MessageRequest $request, Shop $shop)
    {
        Message::createNew($request->get('title'), $request->get('message'), $shop->id, null, "shop");

        flash('انجام شد', 'پیام شما با موفقیت ثبت شد');

        return redirect(route('message.index',compact('shop')));
    }
}
