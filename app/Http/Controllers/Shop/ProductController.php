<?php

namespace App\Http\Controllers\Shop;


use App\Http\Requests\Shop\ProductAddFeaturesRequest;
use App\Http\Requests\Shop\ProductAddPhotoRequest;
use App\Http\Requests\Shop\ProductDeleteFeatureRequest;
use App\Http\Requests\Shop\ProductDeletePhotoRequest;
use App\Http\Requests\Shop\ProductRequest;
use App\Product;
use App\Shop;
use App\ShopCategory;
use Illuminate\Http\Request;

class ProductController
{

    public function index(Shop $shop)
    {
        $products = $shop->products()->latest()->paginate(20);

        return view('shops.product.index', compact('products', 'shop'));
    }

    public function search(Request $request, $id)
    {
        $products = Product::search($id, $request->data)->latest()->get();
        $shop = Shop::query()->find($id);
        return view('shops.product.searchResult', compact('products','shop'));
    }

    public function show(Shop $shop, Product $product)
    {
        if ($product->features == null)
            $features = [];
        else
            $features = explode(';', $product->features);

        return view('shops.product.show', compact('product', 'features', 'shop'));
    }

    public function create(Shop $shop)
    {
        $shopCategories = ShopCategory::query()->where('shop_id', auth()->id())->get();
        return view('shops.product.create', compact('shopCategories', 'shop'));
    }

    public function store(Shop $shop, ProductRequest $request)
    {
        $shop_products = Product::query()->where('shop_id', auth()->id())->get();

        if (count($shop_products) >= 50) {
            return back()->withErrors('تعداد محصولات شما بیشتر از 50 می باشد');
        }

        $product = Product::createNew($request);

        if ($request->file("photos"))
            $product->createPhoto($request->file("photos"));

        return redirect(route('product.index', compact('shop')));
    }

    public function edit(Shop $shop, Product $product)
    {
        $photos = explode(';', $product->photos);

        $shopCategories = ShopCategory::query()->where('shop_id', auth()->id())->get();

        if ($product->features == null)
            $features = [];
        else
            $features = explode(';', $product->features);

        return view('shops.product.edit', compact('product', 'shopCategories', 'photos', 'features', 'shop'));

    }

    public function update(Shop $shop, ProductRequest $request, Product $product)
    {
        $product->update($request->except(['photos', 'admin_verification']));

        return redirect(route('product.index', 'shop'));
    }

    public function destroy(Shop $shop, Product $product)
    {
        $product->delete();

        return redirect(route('product.index', compact('shop')));
    }

    public function deletePhoto(ProductDeletePhotoRequest $request, Shop $shop, Product $product)
    {
        deletePhoto($product, $request);

        return back();
    }

    public function addFeature(ProductAddFeaturesRequest $request, Shop $shop, Product $product)
    {
        $product->addFeatures($request);

        flash('موفق', 'ویژگی جدید با موفقیت ثبت شد');

        return back();
    }

    public function deleteFeature(ProductDeleteFeatureRequest $request, Shop $shop, Product $product)
    {
        $product->deleteFeatures($request);

        return back();
    }

    public function addPhoto(ProductAddPhotoRequest $request, Shop $shop, Product $product)
    {
        $product->createPhoto($request->file('photos'));

        flash('success', 'با موفقیت انجام شد');
        return back();
    }
}
