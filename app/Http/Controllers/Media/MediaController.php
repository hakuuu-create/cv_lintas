<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    // public function index()
    // {
    //     $totalKegiatan = Portofolio::count();
    //     return view('media.dashboard', compact('totalKegiatan'));
    // }

    // ==========================================
    // ⚙️ PENGELOLAAN PROFIL
    // ==========================================
    public function editProfil()
    {
        // Ambil data profil atau buat instansiasi kosong jika belum pernah diisi
        $profil = ProfilPerusahaan::first() ?? new ProfilPerusahaan();
        return view('media.profil', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $profil = ProfilPerusahaan::first() ?? new ProfilPerusahaan();

        // 1. Definisikan aturan validasi dengan batas max 5048 KB (5 MB)
        $rules = [
            // 'nama_perusahaan' => 'required|string|max:255',
            // 'sejarah_singkat' => 'required',
            // 'alamat' => 'required',
            'whatsapp_kontak' => 'required|numeric',
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'gambar_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg|max:5048'
        ];

        $messages = [
            'logo_perusahaan.image' => 'File yang diunggah harus berupa gambar.',
            'logo_perusahaan.mimes' => 'Format gambar harus berupa jpeg, png, atau jpg.',
            'logo_perusahaan.max' => 'Ukuran foto logo terlalu besar! Maksimal ukuran yang diperbolehkan adalah 5 MB (5048 KB).',
            'gambar_perusahaan.image' => 'File yang diunggah harus berupa gambar.',
            'gambar_perusahaan.mimes' => 'Format gambar harus berupa jpeg, png, atau jpg.',
            'gambar_perusahaan.max' => 'Ukuran foto logo terlalu besar! Maksimal ukuran yang diperbolehkan adalah 5 MB (5048 KB).',
        ];

        $request->validate($rules, $messages);

        // Pemetaan data secara manual
        // $profil->nama_perusahaan = $request->nama_perusahaan;
        // $profil->sejarah_singkat = $request->sejarah_singkat;
        // $profil->alamat = $request->alamat;
        $profil->whatsapp_kontak = $request->whatsapp_kontak;
        $profil->instagram_link = $request->instagram_link;
        $profil->facebook_link = $request->facebook_link;
        $profil->youtube_link = $request->youtube_link;

        // Logika Bersihkan & Simpan Logo Perusahaan
        if ($request->hasFile('logo_perusahaan')) {
            // Jika sebelumnya sudah ada logo lama, hapus dari backend agar tidak menumpuk
            if ($profil->logo_perusahaan) {
                Storage::disk('public')->delete($profil->logo_perusahaan);
            }
            // Simpan logo baru ke folder storage/app/public/assets/logo
            $profil->logo_perusahaan = $request->file('logo_perusahaan')->store('assets/logoPerusahaan', 'public');
        }

        // Logika Bersihkan & Simpan Gambar Perusahaan
        if ($request->hasFile('gambar_perusahaan')) {
            // Jika sebelumnya sudah ada gambar lama, hapus dari backend agar tidak menumpuk
            if ($profil->gambar_perusahaan) {
                Storage::disk('public')->delete($profil->gambar_perusahaan);
            }
            // Simpan gambar baru ke folder storage/app/public/assets/gambar
            $profil->gambar_perusahaan = $request->file('gambar_perusahaan')->store('assets/logoPerusahaan', 'public');
        }

        $profil->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}