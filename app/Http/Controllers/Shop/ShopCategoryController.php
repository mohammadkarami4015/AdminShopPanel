<?php

namespace App\Http\Controllers\Shop;


use App\Http\Requests\Shop\ShopCategoryRequest;
use App\Shop;
use App\ShopCategory;
use Illuminate\Http\Request;

class ShopCategoryController
{
    public function index(Shop $shop)
    {
        $shopCategories = $shop->shopCategories()->latest()->paginate(20);

        return view('shops.shopCategory.index', compact('shopCategories', 'shop'));
    }

    public function search(Request $request,Shop $shop)
    {
        $shopCategories = ShopCategory::search($shop->id, $request->data)->latest()->get();

        return view('shops.shopCategory.searchResult', compact('shopCategories','shop'));
    }

    public function create(Shop $shop)
    {
        return view('shops.shopCategory.create', compact('shop'));
    }

    public function store(ShopCategoryRequest $request, Shop $shop)
    {
        $shop->shopCategories()->create($request->validated());

        return redirect(route('shopCategory.index', $shop));
    }

    public function edit(Shop $shop, ShopCategory $shopCategory)
    {
        return view('shops.shopCategory.edit', compact('shopCategory', 'shop'));
    }

    public function update(ShopCategoryRequest $request, Shop $shop, ShopCategory $shopCategory)
    {
        $shopCategory->update($request->validated());

        return redirect(route('shopCategory.index', $shop));
    }

    public function destroy(shop $shop, ShopCategory $shopCategory)
    {
        $shopCategory->delete();

        return redirect(route('shopCategory.index', $shop));
    }

}
