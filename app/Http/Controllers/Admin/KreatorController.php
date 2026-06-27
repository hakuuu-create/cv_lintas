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
            'nama'     => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'platform' => 'required|string',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('assets/kreator', 'public');
        }

        Kreator::create([
            'nama'     => $request->nama,
            'username' => $request->username,
            'platform' => $request->platform,
            'foto'     => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Kreator berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kreator = Kreator::findOrFail($id);

        $request->validate([
            'nama'     => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'platform' => 'required|string',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kreator->nama     = $request->nama;
        $kreator->username = $request->username;
        $kreator->platform = $request->platform;

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