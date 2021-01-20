<?php

namespace App\Http\Controllers\Shop;


use App\Discount;
use App\Http\Requests\Shop\DiscountRequest;
use App\Shop;
use Illuminate\Http\Request;

class DiscountController
{
    public function index(Shop $shop)
    {
        $discounts = $shop->discount()->latest()->paginate(20);

        return view('shops.discount.index', compact('discounts', 'shop'));
    }

    public function search(Request $request, Shop $shop)
    {
        $discounts = Discount::search($shop->id, $request->data)->latest()->paginate(20);

        return view('shops.discount.searchResult', compact('discounts','shop'));
    }

    public function create(Shop $shop)
    {
        $products = $shop->products;

        $categories = $shop->shopCategories;

        return view('shops.discount.create', compact('products', 'categories', 'shop'));

    }

    public function store(DiscountRequest $request, Shop $shop)
    {
        Discount::createNew($request, $shop);

        return redirect(route('discount.index', $shop));
    }

    public function show(Shop $shop, Discount $discount)
    {
        $products = explode(',', $discount->products);
        $categories = explode(',', $discount->categories);
        $exceptProducts = explode(',', $discount->except_products);
        $exceptCategories = explode(',', $discount->except_categories);

        return view('shops.discount.show',
            compact(
                'discount',
                'products',
                'exceptProducts',
                'categories',
                'exceptCategories',
                'shop'
            ));
    }

    public function edit(Shop $shop, Discount $discount)
    {
        $discountProducts = explode(',', $discount->products);
        $discountCategories = explode(',', $discount->categories);
        $discountExceptProducts = explode(',', $discount->except_products);
        $discountExceptCategories = explode(',', $discount->except_categories);

        $products = $shop->products;

        $categories = $shop->shopCategories;

        return view('shops.discount.edit',
            compact('discount',
                'products',
                'categories',
                'discountProducts',
                'discountExceptProducts',
                'discountCategories',
                'discountExceptCategories',
                'shop'
            ));
    }

    public function update(DiscountRequest $request, Shop $shop, Discount $discount)
    {
        $discount->updateDiscount($request);

        if ($request->expire) {
            $discount->updateExpire($request->get('expire'));
        }
        flash('success');
        return back();
    }

    public function destroy(Shop $shop, Discount $discount)
    {
        $discount->delete();

        return redirect(route('discount.index',$shop));
    }

}
