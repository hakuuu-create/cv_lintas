<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;
use App\Models\PengaturanProfil;
use App\Models\Layanan;
use App\Models\Portofolio;
use App\Models\Kreator;

class LandingPageController extends Controller
{
    public function index()
    {
        // Identitas, kontak, sosmed, visi-misi perusahaan (single record)
        $pengaturan  = PengaturanProfil::first();

        // Konten profil perusahaan yang dikelola di admin > Profil Perusahaan
        $profils     = ProfilPerusahaan::latest()->get();

        $layanan     = Layanan::all();
        $portofolios = Portofolio::where('is_active', 1)->latest()->get();
        $kreator     = Kreator::latest()->get();

        return view('landing.index', compact(
            'pengaturan',
            'profils',
            'layanan',
            'portofolios',
            'kreator'
        ));
    }
}