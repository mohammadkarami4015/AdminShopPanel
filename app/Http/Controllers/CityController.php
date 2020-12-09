<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Http\Requests\CityRequest;

class CityController
{

    public function index()
    {
        $cities = City::query()->latest()->paginate(20);

        return view('city.index', compact('cities'));
    }


    public function create()
    {
        $countries = Country::query()->where('status', 'on')->get();

        return view('city.create', compact('countries'));
    }


    public function store(CityRequest $request)
    {
        City::query()->create($request->validated());

        flash('شهر جدید با موفقیت ثبت شد');

        return back();
    }

    public function edit(City $city)
    {
        $countries = Country::query()->where('status', 'on')->get();

        return view('city.edit', compact('countries', 'city'));
    }


    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());

        flash('شهر مورد نظر با موفقیت ویرایش شد');

        return redirect(route('city.index'));
    }

    public function destroy(City $city)
    {
        $city->delete();

        flash('شهر مورد نظر با موفقیت  حذف شد');

        return back();
    }
}
