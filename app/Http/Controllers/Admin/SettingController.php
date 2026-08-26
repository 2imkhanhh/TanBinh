<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settingsData = Setting::all();
        $settings = [];
        foreach($settingsData as $setting) {
            $settings[$setting->key] = $setting->getTranslations('value');
        }

        return Inertia::render('Admin/Settings/Index', [
            'settings' => (object)$settings
        ]);
    }

    public function email()
    {
        $settingsData = Setting::all();
        $settings = [];
        foreach($settingsData as $setting) {
            $val = $setting->getTranslations('value');
            $settings[$setting->key] = is_array($val) ? ($val['vi'] ?? '') : $val;
        }

        return Inertia::render('Admin/Settings/Email', [
            'settings' => (object)$settings
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        // Handle JSON array fields (e.g. banners, partners)
        $jsonFields = ['home_banners', 'home_partners', 'ingredient_partners', 'hospital_partners', 'media_partners', 'contact_stores'];
        foreach ($jsonFields as $field) {
            if (isset($data[$field])) {
                $items = [];
                foreach ($data[$field] as $item) {
                    $itemData = [];
                    // basic text fields within json arrays usually don't need vi/en unless we want to overcomplicate.
                    // For simplicity, let's keep them as single strings if they come as such, or arrays if they come as such.
                    if (isset($item['name'])) $itemData['name'] = $item['name'];
                    if (isset($item['description'])) $itemData['description'] = $item['description'];
                    if (isset($item['address'])) $itemData['address'] = $item['address'];
                    if (isset($item['phone'])) $itemData['phone'] = $item['phone'];
                    if (isset($item['link'])) $itemData['link'] = $item['link'];

                    // Translations handling within JSON arrays if needed (like name.vi, name.en)
                    if (isset($item['name_vi'])) $itemData['name_vi'] = $item['name_vi'];
                    if (isset($item['name_en'])) $itemData['name_en'] = $item['name_en'];
                    if (isset($item['desc_vi'])) $itemData['desc_vi'] = $item['desc_vi'];
                    if (isset($item['desc_en'])) $itemData['desc_en'] = $item['desc_en'];

                    if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $file = $item['image'];
                        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/settings'), $filename);
                        $itemData['img'] = 'uploads/settings/' . $filename;
                    } elseif (isset($item['old_image'])) {
                        $itemData['img'] = $item['old_image'];
                    }

                    if (isset($itemData['img']) || $field === 'contact_stores' || $field === 'home_banners') {
                        $items[] = $itemData;
                    }
                }
                
                $setting = Setting::firstOrCreate(['key' => $field]);
                $setting->setTranslations('value', [
                    'vi' => json_encode($items),
                    'en' => json_encode($items) // json lists share same structural string for simplicity
                ]);
                $setting->save();

                unset($data[$field]);
            } else if ($request->exists($field)) {
                $setting = Setting::firstOrCreate(['key' => $field]);
                $setting->setTranslations('value', ['vi' => json_encode([]), 'en' => json_encode([])]);
                $setting->save();
                unset($data[$field]);
            }
        }

        // Handle normal fields
        foreach ($data as $key => $values) {
            $setting = Setting::firstOrCreate(['key' => $key]);

            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                
                $path = 'uploads/settings/' . $filename;
                // Delete old file if exists
                $oldSetting = $setting->getTranslations('value');
                $oldPath = $oldSetting['vi'] ?? ($oldSetting['en'] ?? null);
                if ($oldPath && file_exists(public_path($oldPath)) && !is_dir(public_path($oldPath))) {
                    @unlink(public_path($oldPath));
                }

                $setting->setTranslations('value', [
                    'vi' => $path,
                    'en' => $path
                ]);
                $setting->save();
            } else if (is_array($values) && (isset($values['vi']) || isset($values['en']))) {
                $setting->setTranslations('value', [
                    'vi' => $values['vi'] ?? '',
                    'en' => $values['en'] ?? ''
                ]);
                $setting->save();
            } else if (!is_array($values) && $values !== null) {
                // If it's a plain string (not array of vi/en), set it for both
                $setting->setTranslations('value', [
                    'vi' => $values,
                    'en' => $values
                ]);
                $setting->save();
            }
        }

        return redirect()->back()->with('success', 'Đã cập nhật cấu hình nội dung!');
    }
}
