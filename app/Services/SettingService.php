<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function getSetting(string $key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public function getAllSettingsByGroup(string $group): array
    {
        return Setting::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }

    public function updateSetting(string $key, $value, string $type = 'string', string $group = 'general'): Setting
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
    }

    public function getAllPublicSettings(): array
    {
        return Setting::where('is_public', true)
            ->pluck('value', 'key')
            ->toArray();
    }
}