<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        // Fetch all settings and map them to an array keyed by their 'key'
        $settingsData = Setting::all();
        $settings = [];
        foreach($settingsData as $setting) {
            $settings[$setting->key] = $setting->getTranslations('value');
        }

        return Inertia::render('Admin/Settings/Index', [
            'settings' => (object)$settings // Cast to object so Vue receives it as a dictionary
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        
        foreach ($data as $key => $values) {
            if(is_array($values) && (isset($values['vi']) || isset($values['en']))) {
                $setting = Setting::firstOrCreate(['key' => $key]);
                $setting->setTranslations('value', [
                    'vi' => $values['vi'] ?? '',
                    'en' => $values['en'] ?? ''
                ]);
                $setting->save();
            }
        }

        return redirect()->back()->with('success', 'Đã lưu cấu hình!');
    }
}
