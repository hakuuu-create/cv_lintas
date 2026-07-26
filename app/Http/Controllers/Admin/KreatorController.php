<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kreator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KreatorController extends Controller
{
    public function index()
    {
        $kreator = Kreator::latest()->get();
        return view('admin.kreator.index', compact('kreator'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'judul' => 'nullable|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'username' => 'required|string|max:255',
            'platform' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // Opsional
            'nama_2' => 'nullable|string|max:255',
            'username_2' => 'nullable|string|max:255',
            'platform_2' => 'nullable|string',

            'nama_3' => 'nullable|string|max:255',
            'username_3' => 'nullable|string|max:255',
            'platform_3' => 'nullable|string',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('assets/kreator', 'public');
        }

        Kreator::create([
            'nama' => $request->nama,
            'judul' => $request->judul,
            'sub_judul' => $request->sub_judul,
            'deskripsi' => $request->deskripsi,
            'username' => $request->username,
            'platform' => $request->platform,
            'foto' => $fotoPath,

            // Opsional
            'nama_2' => $request->nama_2,
            'username_2' => $request->username_2,
            'platform_2' => $request->platform_2,

            'nama_3' => $request->nama_3,
            'username_3' => $request->username_2,
            'platform_3' => $request->platform_2,
        ]);

        return redirect()->back()->with('success', 'Kreator berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kreator = Kreator::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'judul' => 'nullable|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'username' => 'required|string|max:255',
            'platform' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // Opsional
            'nama_2' => 'nullable|string|max:255',
            'username_2' => 'nullable|string|max:255',
            'platform_2' => 'nullable|string',

            'nama_3' => 'nullable|string|max:255',
            'username_3' => 'nullable|string|max:255',
            'platform_3' => 'nullable|string',
        ]);

        $kreator->nama = $request->nama;
        $kreator->judul = $request->judul;
        $kreator->sub_judul = $request->sub_judul;
        $kreator->deskripsi = $request->deskripsi;
        $kreator->username = $request->username;
        $kreator->platform = $request->platform;

        // Opsional
        $kreator->nama_2 = $request->nama_2;
        $kreator->username_2 = $request->username_2;
        $kreator->platform_2 = $request->platform_2;

        $kreator->nama_3 = $request->nama_3;
        $kreator->username_3 = $request->username_3;
        $kreator->platform_3 = $request->platform_3;

        if ($request->hasFile('foto')) {
            if ($kreator->foto) {
                Storage::disk('public')->delete($kreator->foto);
            }
            $kreator->foto = $request->file('foto')->store('assets/kreator', 'public');
        }

        $kreator->save();

        return redirect()->back()->with('success', 'Kreator berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kreator = Kreator::findOrFail($id);
        if ($kreator->foto) {
            Storage::disk('public')->delete($kreator->foto);
        }
        $kreator->delete();

        return redirect()->back()->with('success', 'Kreator berhasil dihapus!');
    }
}