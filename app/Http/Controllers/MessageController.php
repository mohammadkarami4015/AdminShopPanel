<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shop\MessageRequest;
use App\Message;
use App\Shop;

class MessageController
{
    public function index()
    {
        $messages = Message::query()->latest()->paginate();

        return view('message.index', compact('messages'));
    }

    public function create()
    {
        return view('message.create');
    }

    public function store(MessageRequest $request, Shop $shop)
    {
        Message::createNew($request->get('title'), $request->get('message'), '', null, "shop");

        flash('انجام شد', 'پیام شما با موفقیت ثبت شد');

        return redirect(route('message.index', compact('shop')));
    }
}
