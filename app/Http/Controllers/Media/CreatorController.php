<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreatorController extends Controller
{
    // Tampilkan form edit (single row settings, seperti profil)
    public function edit()
    {
        $kreator = Creator::first();

        // Jika belum ada data sama sekali, buat row kosong agar form tidak error
        if (!$kreator) {
            $kreator = Creator::create([]);
        }

        return view('media.creator.edit', compact('kreator'));
    }

    // Update data kreator & foto section
    public function update(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
            'username_1' => 'nullable|string|max:255',
            'username_2' => 'nullable|string|max:255',
            'username_3' => 'nullable|string|max:255',
        ]);

        $kreator = Creator::first();
        if (!$kreator) {
            $kreator = new Creator();
        }

        $kreator->username_1 = $request->username_1;
        $kreator->username_2 = $request->username_2;
        $kreator->username_3 = $request->username_3;

        // Ganti foto hanya jika admin upload foto baru (opsional)
        if ($request->hasFile('foto')) {
            if ($kreator->foto) {
                Storage::disk('public')->delete($kreator->foto);
            }
            $kreator->foto = $request->file('foto')->store('assets/kreator', 'public');
        }

        $kreator->save();

        return redirect()->back()->with('success', 'Data kreator berhasil diperbarui!');
    }
}