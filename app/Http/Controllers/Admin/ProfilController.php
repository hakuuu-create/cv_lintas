<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // ==========================================
    // PROFIL PERUSAHAAN
    // ==========================================
    public function editProfil()
    {
        $profil = ProfilPerusahaan::first() ?? new ProfilPerusahaan();
        return view('admin.profil', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $profil = ProfilPerusahaan::first() ?? new ProfilPerusahaan();

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'sejarah_singkat' => 'required',
            'visi'            => 'required',
            'misi'            => 'required',
            'alamat'          => 'required',
            'whatsapp_kontak' => 'required',
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profil->nama_perusahaan = $request->nama_perusahaan;
        $profil->sejarah_singkat = $request->sejarah_singkat;
        $profil->visi            = $request->visi;
        $profil->misi            = $request->misi;
        $profil->alamat          = $request->alamat;
        $profil->whatsapp_kontak = $request->whatsapp_kontak;
        $profil->instagram_link  = $request->instagram_link;
        $profil->facebook_link   = $request->facebook_link;
        $profil->youtube_link    = $request->youtube_link;

        if ($request->hasFile('logo_perusahaan')) {
            if ($profil->logo_perusahaan) {
                Storage::disk('public')->delete($profil->logo_perusahaan);
            }
            $profil->logo_perusahaan = $request->file('logo_perusahaan')
                ->store('assets/logo', 'public');
        }

        $profil->save();

        return redirect()->back()->with('success', 'Profil perusahaan berhasil diperbarui!');
    }
}