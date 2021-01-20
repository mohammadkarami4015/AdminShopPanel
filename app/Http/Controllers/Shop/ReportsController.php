<?php

namespace App\Http\Controllers\Shop;

use App\Order;
use App\Product;
use App\Shop;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class ReportsController
{
    public function index()
    {
        $products_id = [];
        $products_unique_id = [];
        $totalPrice = 0;

        $jDateNowDay = Jalalian::now()->getDay();
        $firstDayOfMonth = Carbon::now()->addDays(-$jDateNowDay + 1);
        $orders = Order::query()->whereDate('created_at', '>=', $firstDayOfMonth)->where('order_status', 4)->get();


        foreach ($orders as $order) {
            $items = explode(";", $order->products);
            foreach ($items as $item) {
                $products = explode(",", $item);
                array_push($products_unique_id, $products[0]);
                for ($i = 0; $i < $products[1]; $i++) {
                    array_push($products_id, $products[0]);
                }
            }
        }
        $counted_values = array_count_values($products_id);
        $products = Product::query()->whereIn('id', $products_unique_id)->get();

        foreach ($orders as $order) {
            $totalPrice = $totalPrice + $order->total_price;
        }

        return view('shops.report.index', compact('products', 'totalPrice', 'counted_values'));

    }
}
