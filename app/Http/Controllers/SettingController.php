<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Setting $setting)
    {
        $setting = $setting->first();
        return view('admin.settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namesetting'       => 'required|string',
            'slug'              => 'required|string',
            'description'       => 'required|string',
            'mobile'            => 'required|numeric',
            'facebook'          => 'nullable|url',
            'instagram'         => 'nullable|url',
            'type'              => 'nullable|numeric'
        ]);

        Setting::create($request->all());
        session()->flash('success', 'تم أضافه الاعدادات بنجاح');
        return redirect('adminpanel');
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'namesetting'       => 'required|string',
            'slug'              => 'required|string',
            'description'       => 'required|string',
            'mobile'            => 'required|numeric',
            'facebook'          => 'nullable|url',
            'instagram'         => 'nullable|url',
            'type'              => 'nullable|numeric'
        ]);

        $setting->update($request->all());
        session()->flash('success', 'تم أضافه الاعدادات بنجاح');
        return redirect('adminpanel');
    }
}
