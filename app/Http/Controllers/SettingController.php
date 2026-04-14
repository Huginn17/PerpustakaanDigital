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
                'denda_per_hari' => 10000,
                'max_hari_pinjam' => 14
            ]);
        }


        return view('kepala_perpus.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'denda_per_hari' => 'required',
            'max_hari_pinjam' => 'required|integer|min:1'
        ]);

        $denda = preg_replace('/[^0-9]/', '', $request->denda_per_hari);

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'denda_per_hari' => $denda,
                'max_hari_pinjam' => $request->max_hari_pinjam
            ]
        );

        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
