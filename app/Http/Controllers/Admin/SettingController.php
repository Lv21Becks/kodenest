<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $dbSettings = SiteSetting::all()->pluck('value', 'key')->toArray();

        $defaults = [
            'site_name' => 'KodeNest ICT Academy',
            'site_tagline' => 'Building Africa\'s Next Generation of Tech Talent',
            'site_description' => 'A leading ICT Academy dedicated to training the next generation of software engineers, data analysts, and product designers.',
            'contact_email' => 'Kodenestlimited@gmail.com',
            'contact_phone' => '07016262826',
            'contact_address' => '154 Isoko Road, By NNPC Roundabout, Ughelli, Delta State',
            'social_facebook' => '',
            'social_twitter' => '',
            'social_instagram' => '',
            'social_linkedin' => '',
            'site_logo' => asset('images/logo.png'),
            'site_favicon' => asset('favicon.ico'),
        ];

        // Merge DB settings over defaults (DB takes precedence if exists and not empty)
        $settings = array_merge($defaults, array_filter($dbSettings));

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!');
    }
}
