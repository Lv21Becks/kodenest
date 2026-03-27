<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    /**
     * Display the global system settings grouped by their category.
     */
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the global application settings dynamically.
     */
    public function update(Request $request)
    {
        // Settings come in via $request->settings as an array [key => value]
        $settingsData = $request->input('settings', []);

        // Due to HTML checkboxes, unchecked booleans won't be in the request array.
        // We will fetch all boolean settings from the DB, and if they are missing from the request, set them to 'false'.
        $booleanSettings = Setting::where('type', 'boolean')->pluck('key')->toArray();

        foreach ($booleanSettings as $boolKey) {
            if (!array_key_exists($boolKey, $settingsData)) {
                $settingsData[$boolKey] = 'false';
            } else {
                $settingsData[$boolKey] = 'true';
            }
        }

        // Loop through the data and update the database
        foreach ($settingsData as $key => $value) {
            // Do not update keys that don't exist originally
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                // If the type is boolean, value is already true/false string.
                // Otherwise save whatever string/text came through.
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Global Settings have been beautifully updated.');
    }
}
