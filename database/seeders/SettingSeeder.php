<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'applications_open', 'value' => 'true', 'type' => 'boolean', 'group' => 'admissions'],
            ['key' => 'contact_email', 'value' => 'info@kodenest.com', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+234 812 345 6789', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'office_address', 'value' => '123 Tech Hub Avenue, Lagos', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/kodenest', 'type' => 'string', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/kodenest', 'type' => 'string', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'site_name', 'value' => 'KodeNest', 'type' => 'string', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
