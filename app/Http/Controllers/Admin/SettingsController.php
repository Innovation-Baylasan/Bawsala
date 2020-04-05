<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $terms = Setting::firstOrNew(['key' => 'terms'], ['value' => '']);

        $policy = Setting::firstOrNew(['key' => 'policy'], ['value' => '']);

        return view('admin.settings.index', compact('terms', 'policy'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'key' => 'required',
            'value' => 'required',
        ]);

        $setting = Setting::firstOrNew(['key' => $attributes['key']]);

        $setting->value = $attributes['value'];

        $setting->save();

        return response(['message' => $attributes['key'] . ' has been updated']);
    }
}
