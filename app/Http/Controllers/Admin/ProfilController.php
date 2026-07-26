<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaturanProfil;
use App\Models\ProfilPerusahaan;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // ==========================================
    // PENGATURAN PROFIL (nama, logo, kontak, dll)
    // ==========================================
    public function editPengaturan()
{
    $profil = PengaturanProfil::first() ?? new PengaturanProfil();
    return view('admin.pengaturan_profil', compact('profil'));
}

    public function updatePengaturan(Request $request)
    {
        $pengaturan = PengaturanProfil::first() ?? new PengaturanProfil();

        $request->validate([
            'nama_perusahaan'   => 'required|string|max:255',
            'sejarah_singkat'   => 'nullable',
            'visi'              => 'nullable',
            'misi'              => 'nullable',
            'alamat'            => 'required',
            'whatsapp_kontak'   => 'required',
            'logo_perusahaan'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
        ]);

        $pengaturan->nama_perusahaan = $request->nama_perusahaan;
        $pengaturan->sejarah_singkat = $request->sejarah_singkat;
        $pengaturan->visi            = $request->visi;
        $pengaturan->misi            = $request->misi;
        $pengaturan->alamat          = $request->alamat;
        $pengaturan->whatsapp_kontak = $request->whatsapp_kontak;
        $pengaturan->instagram_link  = $request->instagram_link;
        $pengaturan->facebook_link   = $request->facebook_link;
        $pengaturan->youtube_link    = $request->youtube_link;

        if ($request->hasFile('logo_perusahaan')) {
            if ($pengaturan->logo_perusahaan) {
                Storage::disk('public')->delete($pengaturan->logo_perusahaan);
            }
            $pengaturan->logo_perusahaan = $request->file('logo_perusahaan')
                ->store('assets/logo', 'public');
        }

        if ($request->hasFile('gambar_perusahaan')) {
            if ($pengaturan->gambar_perusahaan) {
                Storage::disk('public')->delete($pengaturan->gambar_perusahaan);
            }
            $pengaturan->gambar_perusahaan = $request->file('gambar_perusahaan')
                ->store('assets/gambar', 'public');
        }

        $pengaturan->save();

        return redirect()->back()->with('success', 'Pengaturan profil berhasil diperbarui!');
    }

    // ==========================================
    // PROFIL PERUSAHAAN (tampil di landing page)
    // ==========================================
    public function profilIndex()
    {
        $profils = ProfilPerusahaan::latest()->get();
        return view('admin.profil_perusahaan.index', compact('profils'));
    }

    public function profilStore(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'konten'    => 'required|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
        ]);

        $profil           = new ProfilPerusahaan();
        $profil->judul    = $request->judul;
        $profil->sub_judul = $request->sub_judul;
        $profil->konten   = $request->konten;

        if ($request->hasFile('foto')) {
            $profil->foto = $request->file('foto')->store('assets/profil', 'public');
        }

        $profil->save();

        return redirect()->back()->with('success', 'Profil berhasil ditambahkan!');
    }

    public function profilUpdate(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'konten'    => 'required|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
        ]);

        $profil            = ProfilPerusahaan::findOrFail($id);
        $profil->judul     = $request->judul;
        $profil->sub_judul = $request->sub_judul;
        $profil->konten    = $request->konten;

        if ($request->hasFile('foto')) {
            if ($profil->foto) {
                Storage::disk('public')->delete($profil->foto);
            }
            $profil->foto = $request->file('foto')->store('assets/profil', 'public');
        }

        $profil->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function profilDestroy($id)
    {
        $profil = ProfilPerusahaan::findOrFail($id);
        if ($profil->foto) {
            Storage::disk('public')->delete($profil->foto);
        }
        $profil->delete();

        return redirect()->back()->with('success', 'Profil berhasil dihapus!');
    }
}