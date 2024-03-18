<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function list()
    {
        $data['items'] = Setting::all();
        return view('admin.settings.list', $data);
    }

    public function edit()
    {
        $data['items'] = Setting::all();
        return view('admin.settings.form', $data);
    }

    public function update(Request $request)
    {
//        return $request;
        Setting::updateSetting($request);
        return redirect()->route('admin.setting.list')->with('message', 'Setting Has Been Updated Successfully!!');
    }
}
