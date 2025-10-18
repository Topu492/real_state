<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
     public function logo()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.logo', compact('setting'));
    }

    
    public function logo_update(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $setting = Setting::where('id',1)->first();
        $final_name = 'logo_'.time().'.'.$request->logo->extension();
        if($setting->logo != '') {
            unlink(public_path('uploads/'.$setting->logo));
        }
        $request->logo->move(public_path('uploads'), $final_name);
        $setting->logo = $final_name;
        $setting->save();

        return redirect()->back()->with('success', 'Logo updated successfully');
    }
}
