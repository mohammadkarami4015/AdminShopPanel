<?php

namespace App\Http\Controllers\Shop;


use App\City;
use App\Country;
use App\Group;
use App\Http\Requests\Shop\ShopAddLogoRequest;
use App\Http\Requests\Shop\ShopAddPhotoRequest;
use App\Http\Requests\Shop\ShopCreateSendPriceRequest;
use App\Http\Requests\Shop\ShopDeletePhotoRequest;
use App\Http\Requests\Shop\ShopDeleteSendPriceRequest;
use App\Http\Requests\Shop\ShopUpdateRequest;
use App\Http\Requests\Shop\ShopWorkingTimeRequest;
use App\Shop;
use App\Subgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ShopController
{

    public function index()
    {
        $shops = Shop::query()->latest()->paginate(20);
        return view('shops.shop.index', compact('shops'));
    }

    public function details(Shop $shop)
    {
        if ($shop->send_prices == null)
            $sendPrices = [];
        else
            $sendPrices = explode(';', $shop->send_prices);

        return view('shops.shop.details', compact('shop', 'sendPrices'));
    }

    public function edit(Shop $shop)
    {
        $countries = Country::all();
        $cities = City::all();
        $groups = Group::all();
        $subGroups = Subgroup::all();
        $photos = explode(';', $shop->photos);

        if ($shop->send_prices == null)
            $sendPrices = [];
        else
            $sendPrices = explode(';', $shop->send_prices);

        return view('shops.shop.edit', compact('shop', 'countries', 'cities', 'groups', 'subGroups', 'photos', 'sendPrices'));
    }

    public function update(ShopUpdateRequest $request, Shop $shop)
    {
        $shop->updateShop($request);

        return redirect(route('shop.details', $shop));
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();

        flash('فروشگاه مورد نظر با موفقیت حذف شد');

        return back();
    }

    public function deletePhoto(ShopDeletePhotoRequest $request, Shop $shop)
    {
        if ($request->type == "photo") {
            deletePhoto($shop, $request);
        }
        if ($request->type == "logo") {
            File::delete($shop->logo);
            $shop->logo = null;
            $shop->save();
        }

        return back();
    }

    public function createSendPrice(ShopCreateSendPriceRequest $request, Shop $shop)
    {
        $shop->addSendPrice($request);

        flash('موفق', 'هزینه ارسال جدید با موفقیت ثبت شد');

        return back();
    }

    public function deleteSendPrice(ShopDeleteSendPriceRequest $request, Shop $shop)
    {
        deleteSendPrice($shop, $request);

        return back();
    }

    public function addPhoto(ShopAddPhotoRequest $request, Shop $shop)
    {
        $shop->createPhoto($request);

        flash('موفق', 'عکس جدید با موفقیت اضافه شد');

        return back();

    }

    public function addLogo(ShopAddLogoRequest $request, Shop $shop)
    {

        $shop->logo = $shop->addLogo($request->file("logo"));

        $shop->save();

        flash('موفق', 'لوگوی جدید با موفقیت جایگزین شد');

        return back();
    }

    public function workingHour(ShopWorkingTimeRequest $request, Shop $shop)
    {

        $shop->updateWorkingTime($request);

        flash('موفق', 'ساعت کاری با موفقیت ویرایش شد');

        return back();
    }

    public function updateLatLang(Shop $shop, Request $request)
    {
        $shop->lat = $request->get('lat');
        $shop->lng = $request->get('lng');
        $shop->save();
        flash('موفق', 'مخصتات مورد نظر با موفقیت ذخیره شد');

        return back();

    }

    public function activate($id, $value)
    {
        $shop = Shop::query()->findOrFail($id);
        $shop->update(['admin_verification' => $value]);
    }

    public function search(Request $request)
    {
        $shops = Shop::search($request->get('data'))->latest()->get();

        return view('shops.shop.searchResult', compact('shops'));
    }

}
