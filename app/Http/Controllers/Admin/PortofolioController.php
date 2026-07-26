<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::latest()->get();
        $activeCount = Portofolio::where('is_active', 1)->count();
        return view('admin.portofolio.index', compact('portofolios', 'activeCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'required|boolean',
        ]);

        $activeCount = Portofolio::where('is_active', 1)->count();
        if ((int) $request->is_active === 1 && $activeCount >= 3) {
            return redirect()->back()->withInput()
                ->with('error', 'Maksimal 3 portofolio aktif. Nonaktifkan salah satu terlebih dahulu.');
        }

        $project = new Portofolio();
        $project->judul     = $request->judul;
        $project->sub_judul = $request->sub_judul;
        $project->deskripsi = $request->deskripsi;
        $project->is_active = $request->is_active;

        if ($request->hasFile('foto')) {
            $project->foto = $request->file('foto')->store('assets/portofolio', 'public');
        }

        $project->save();
        return redirect()->back()->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function show($id)
    {
        return response()->json(Portofolio::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'required|boolean',
        ]);

        $project = Portofolio::findOrFail($id);

        if ((int) $request->is_active === 1 && (int) $project->is_active !== 1) {
            $activeCount = Portofolio::where('is_active', 1)->where('id', '!=', $id)->count();
            if ($activeCount >= 3) {
                return redirect()->back()->withInput()
                    ->with('error', 'Maksimal 3 portofolio aktif. Nonaktifkan salah satu terlebih dahulu.');
            }
        }

        $project->judul     = $request->judul;
        $project->sub_judul = $request->sub_judul;
        $project->deskripsi = $request->deskripsi;
        $project->is_active = $request->is_active;

        if ($request->hasFile('foto')) {
            if ($project->foto) {
                Storage::disk('public')->delete($project->foto);
            }
            $project->foto = $request->file('foto')->store('assets/portofolio', 'public');
        }

        $project->save();
        return redirect()->back()->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $project = Portofolio::findOrFail($id);
        if ($project->foto) {
            Storage::disk('public')->delete($project->foto);
        }
        $project->delete();
        return redirect()->back()->with('success', 'Portofolio berhasil dihapus!');
    }
}