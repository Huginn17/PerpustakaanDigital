<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        // kalau belum ada, buat default
        if (!$setting) {
            $setting = Setting::create([
                'denda_per_hari' => 10000
            ]);
        }

        return view('kepala_perpus.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'denda_per_hari' => 'required|numeric|min:0'
        ]);

        $setting = Setting::first();

        if (!$setting) {
            Setting::create([
                'denda_per_hari' => $request->denda_per_hari
            ]);
        } else {
            $setting->update([
                'denda_per_hari' => $request->denda_per_hari
            ]);
        }

        return back()->with('success', 'Denda per hari berhasil diperbarui');
    }
}
