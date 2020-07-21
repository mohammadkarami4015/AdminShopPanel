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

    public function addSlider()
    {
        return view('setting.addSlider');
    }

    public function storeSlider(Request $request)
    {
        $photo = $request->file('file')?makePhotoTypeFile($request->file('file'),'slider'):"";
        $value=$request->link.";".$photo;
        $setting=new Setting();
        $setting->value=$value;
        $setting->title="اسلایدر";
        $setting->key="slider";
        $setting->save();
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('setting.index');
    }


    public function editSlider($id)
    {
        $setting= Setting::find($id);
        return view('setting.editSlider' , compact('setting'));
    }

    public function updateSlider(Request $request,$id)
    {

        $setting=Setting::query()->find($id);
        $photo = $request->file('file')?makePhotoTypeFile($request->file('file'),'slider'):explode(";",$setting->value)[1];
        $value=$request->link.";".$photo;
        $setting->value=$value;
        $setting->save();
        flash()->success('success', 'عملیات با موفقیت انجام شد!');
        return redirect()->route('setting.index');
    }

    public function destroy($id)
    {
         Setting::destroy($id);

        return back();
    }


}
