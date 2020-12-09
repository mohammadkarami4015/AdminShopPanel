<?php

namespace App\Http\Controllers;

use App\Payment;

class PaymentController
{
    public function index()
    {
        $payments = Payment::query()->latest()->paginate(20);

        return view('payment.index', compact('payments'));
    }
}
