<?php

namespace App\Http\Controllers;


use App\Product;
use App\Shop;
use Illuminate\Http\Request;

class ProductController
{
    public function index()
    {
        $products = Product::query()->latest()->paginate(20);

        return view('product.index', compact('products'));
    }

    public function search(Request $request, $id)
    {
        $products = Product::search($id, $request->data)->latest()->get();
        $shop = Shop::query()->find($id);
        return view('shops.product.searchResult', compact('products','shop'));
    }

    public function show( Product $product)
    {
        if ($product->features == null)
            $features = [];
        else
            $features = explode(';', $product->features);

        return view('product.show', compact('product', 'features'));
    }
}
