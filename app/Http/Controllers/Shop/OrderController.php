<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\Shop\OrderUpdateRequest;
use App\Order;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;

class OrderController
{
    public function index(Shop $shop)
    {
        $orders = $shop->orders()->latest()->paginate(20);

        return view('shops.order.index', ['orders' => $orders, 'shop' => $shop, 'status' => 0]);
    }

    public function filterByStatus(Shop $shop, Request $request)
    {
        if ($request->get('status') == 0)
            return redirect(route('order.index', $shop));

        $orders = $shop->orders()->where('order_status', $request->get('status'))->latest()->paginate(20);

        return view('shops.order.index', ['orders' => $orders, 'shop' => $shop, 'status' => $request->get('status')]);
    }

    public function search(Request $request, Shop $shop)
    {
        if ($request->get('status') == 0) {
            $orders = $shop->orders()->where('order_status', $request->get('status'))->latest()->paginate(20);
        }
        else {
            $orders = Order::search($request->get('status'), $shop->id, $request->get('data'))->latest()->get();
        }


        $status = $request->get('status');

        return view('shops.order.searchResult', compact('orders', 'status', 'shop'));
    }

    public function show(Shop $shop, Order $order)
    {
        $productsId = [];
        $productsCount = [];

        $items = explode(";", $order->products);

        if ($order->products)
            foreach ($items as $item) {
                $products = explode(",", $item);

                array_push($productsId, $products[0]);

                array_push($productsCount, $products[1]);
            }


        $orderProducts = Product::query()->whereIn('id', $productsId)->get();

        foreach ($orderProducts as $key => $value) {
            $value->count = $productsCount[$key];
        }

        return view('shops.order.show', compact('order', 'orderProducts', 'shop'));
    }

    public function edit(Shop $shop, Order $order)
    {
        return view('shops.order.edit', compact('order', 'shop'));
    }

    public function update(OrderUpdateRequest $request, Shop $shop, Order $order)
    {
        $order->update($request->only(['order_status', 'send_price', 'address']));

        $order->payed_price = $order->total_price + $order->send_price;

        $order->save();

        flash('success', 'انجام شد');

        return back();
    }
}
