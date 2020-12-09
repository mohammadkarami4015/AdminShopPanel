<?php

namespace App\Http\Controllers\Shop;

use App\Payment;
use App\Shop;

class PaymentsController
{

    public function index(Shop $shop)
    {
        $payments = Payment::query()->where('shop_id', $shop->id)->where('status', 'completed')->latest()->paginate(20);

        return view('shops.payment.index', compact('payments','shop'));
    }

}
