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

    public function search(Request $request)
    {
        $products = Product::searchAll( $request->get('data'))->latest()->get();

        return view('product.searchResult', compact('products'));
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
