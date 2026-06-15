<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;
use App\Models\Kegiatan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function index()
    {
        $totalKegiatan = Kegiatan::count();
        return view('media.dashboard', compact('totalKegiatan'));
    }

    // ==========================================
    // ⚙️ PENGELOLAAN PROFIL PERUSAHAAN
    // ==========================================
    public function editProfil()
    {
        $profil = ProfilPerusahaan::first() ?? new ProfilPerusahaan();
        return view('media.profil', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $profil = ProfilPerusahaan::first() ?? new ProfilPerusahaan();

        $rules = [
            'nama_perusahaan'  => 'required|string|max:255',
            'sejarah_singkat'  => 'required',
            'visi'             => 'required',
            'misi'             => 'required',
            'alamat'           => 'required',
            'whatsapp_kontak'  => 'required|numeric',
            'logo_perusahaan'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $messages = [
            'logo_perusahaan.image' => 'File yang diunggah harus berupa gambar.',
            'logo_perusahaan.mimes' => 'Format gambar harus berupa jpeg, png, atau jpg.',
            'logo_perusahaan.max'   => 'Ukuran foto logo terlalu besar! Maksimal 2 MB.',
        ];

        $request->validate($rules, $messages);

        $profil->nama_perusahaan  = $request->nama_perusahaan;
        $profil->sejarah_singkat  = $request->sejarah_singkat;
        $profil->visi             = $request->visi;
        $profil->misi             = $request->misi;
        $profil->alamat           = $request->alamat;
        $profil->whatsapp_kontak  = $request->whatsapp_kontak;
        $profil->instagram_link   = $request->instagram_link;
        $profil->facebook_link    = $request->facebook_link;
        $profil->youtube_link     = $request->youtube_link;

        if ($request->hasFile('logo_perusahaan')) {
            if ($profil->logo_perusahaan) {
                Storage::delete('public/' . $profil->logo_perusahaan);
            }
            $profil->logo_perusahaan = $request->file('logo_perusahaan')->store('assets/logo', 'public');
        }

        $profil->save();

        return redirect()->back()->with('success', 'Profil perusahaan berhasil diperbarui!');
    }

    // ==========================================
    // 📰 PENGELOLAAN KEGIATAN
    // ==========================================
    public function indexKegiatan()
    {
        $kegiatan = Kegiatan::orderBy('tanggal_kegiatan', 'desc')->paginate(10);
        return view('media.kegiatan.index', compact('kegiatan'));
    }

    public function storeKegiatan(Request $request)
    {
        $request->validate([
            'judul_kegiatan'   => 'required|string|max:255',
            'deskripsi_singkat'=> 'required|max:500',
            'konten_lengkap'   => 'required',
            'tanggal_kegiatan' => 'required|date',
            'foto_kegiatan'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_kegiatan')) {
            $fotoPath = $request->file('foto_kegiatan')->store('assets/kegiatan', 'public');
        }

        Kegiatan::create([
            'judul_kegiatan'   => $request->judul_kegiatan,
            'slug'             => Str::slug($request->judul_kegiatan) . '-' . time(),
            'deskripsi_singkat'=> $request->deskripsi_singkat,
            'konten_lengkap'   => $request->konten_lengkap,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'foto_kegiatan'    => $fotoPath,
            'penulis'          => Auth::user()->name,
        ]);

        return redirect()->back()->with('success', 'Kegiatan baru berhasil dipublikasikan!');
    }

    public function editKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return response()->json($kegiatan);
    }

    public function updateKegiatan(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul_kegiatan'   => 'required|string|max:255',
            'deskripsi_singkat'=> 'required|max:500',
            'konten_lengkap'   => 'required',
            'tanggal_kegiatan' => 'required|date',
            'foto_kegiatan'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kegiatan->judul_kegiatan   = $request->judul_kegiatan;
        $kegiatan->deskripsi_singkat= $request->deskripsi_singkat;
        $kegiatan->konten_lengkap   = $request->konten_lengkap;
        $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;

        if ($request->hasFile('foto_kegiatan')) {
            if ($kegiatan->foto_kegiatan) {
                Storage::delete('public/' . $kegiatan->foto_kegiatan);
            }
            $kegiatan->foto_kegiatan = $request->file('foto_kegiatan')->store('assets/kegiatan', 'public');
        }

        $kegiatan->save();
        return redirect()->back()->with('success', 'Data kegiatan berhasil diubah!');
    }

    public function destroyKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->foto_kegiatan) {
            Storage::delete('public/' . $kegiatan->foto_kegiatan);
        }
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Dokumentasi kegiatan berhasil dihapus!');
    }
}