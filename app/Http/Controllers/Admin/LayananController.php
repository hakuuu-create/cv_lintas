<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::latest()->get();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan'     => 'required|string|max:255',
            'deskripsi_singkat'=> 'required',
            'icon'             => 'nullable|string|max:100',
        ]);

        Layanan::create($request->only('nama_layanan', 'deskripsi_singkat', 'icon'));

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan'     => 'required|string|max:255',
            'deskripsi_singkat'=> 'required',
            'icon'             => 'nullable|string|max:100',
        ]);

        Layanan::findOrFail($id)->update($request->only('nama_layanan', 'deskripsi_singkat', 'icon'));

        return redirect()->back()->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }
}
