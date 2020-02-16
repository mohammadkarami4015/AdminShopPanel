<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $setting= Setting::all();
        return view('setting.show' , compact('setting'));
    }

    public function show()
    {
        $setting= Setting::all();
        return view('setting.show' , compact('setting'));
    }

    public function edit($id)
    {
        $setting= Setting::find($id);
        return view('setting.edit' , compact('setting'));
    }


    public function update(Request $request)
    {
        $setting = Setting::find($request->id);
        $setting->value= $request->value;
        $setting->save();

        // redirect
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('setting.index');

    }

}
