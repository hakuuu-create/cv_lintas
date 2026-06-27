<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    // index
    public function index()
    {
        // Ambil semua data portofolio untuk ditampilkan di halaman index admin
        $portofolios = Portofolio::all();

        // Hitung berapa portofolio yang sedang aktif (tampil di landing page)
        $activeCount = Portofolio::where('is_active', 1)->count();

        return view('admin.kegiatan.index', compact('portofolios', 'activeCount'));
    }

    // create
    public function create()
    {
        return view('admin.kegiatan.card.create');
    }

    // store (Membuat Portofolio Baru)
    public function store(Request $request)
    {
        // Validasi input wajib untuk data baru
        $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:5048',
            'is_active' => 'required|boolean'
        ]);

        // Batasi maksimal 3 portofolio yang aktif (tampil di landing page) sekaligus
        $activeCount = Portofolio::where('is_active', 1)->count();
        if ((int) $request->is_active === 1 && $activeCount >= 3) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Maksimal 3 portofolio aktif yang bisa ditampilkan di landing page. Nonaktifkan salah satu portofolio terlebih dahulu sebelum menambah yang baru.');
        }

        $project = new Portofolio();
        $project->judul = $request->judul;
        $project->sub_judul = $request->sub_judul;
        $project->deskripsi = $request->deskripsi;
        $project->is_active = $request->is_active;

        // Logic upload foto (Langsung simpan karena data baru, belum ada foto lama)
        if ($request->hasFile('foto')) {
            $project->foto = $request->file('foto')->store('assets/foto', 'public');
        }

        $project->save();

        return redirect()->back()->with('success', 'Proyek berhasil ditambahkan!');
    }

    // update (Mengedit Portofolio yang Sudah Ada berdasarkan ID)
    public function update(Request $request, $id)
    {
        // 1. Validasi semua field yang bisa diubah oleh admin
        $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048', // nullable karena admin tidak wajib ganti foto tiap edit
            'is_active' => 'required|boolean'
        ]);

        // 2. Cari data portofolio yang mau diubah
        $project = Portofolio::findOrFail($id);

        // Batasi maksimal 3 portofolio aktif, tidak menghitung data ini sendiri
        if ((int) $request->is_active === 1 && (int) $project->is_active !== 1) {
            $activeCount = Portofolio::where('is_active', 1)->where('id', '!=', $id)->count();
            if ($activeCount >= 3) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Maksimal 3 portofolio aktif yang bisa ditampilkan di landing page. Nonaktifkan salah satu portofolio terlebih dahulu.');
            }
        }

        $project->judul = $request->judul;
        $project->sub_judul = $request->sub_judul;
        $project->deskripsi = $request->deskripsi;
        $project->is_active = $request->is_active;

        // 3. Logic Ganti Foto (Hapus foto lama agar backend tidak menumpuk sampah gambar)
        if ($request->hasFile('foto')) {
            // Cek apakah di database sudah ada file foto lama
            if ($project->foto) {
                Storage::disk('public')->delete($project->foto);
            }
            // Simpan foto baru penggantinya
            $project->foto = $request->file('foto')->store('assets/foto', 'public');
        }

        $project->save();

        return redirect()->back()->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function show($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        return response()->json($portofolio);
    }

    // destroy (Menghapus Portofolio berdasarkan ID)
    public function destroy($id)
    {
        $project = Portofolio::findOrFail($id);

        // Hapus file foto dari storage jika ada, agar tidak menumpuk sampah gambar
        if ($project->foto) {
            Storage::disk('public')->delete($project->foto);
        }

        $project->delete();

        return redirect()->back()->with('success', 'Portofolio berhasil dihapus!');
    }
}