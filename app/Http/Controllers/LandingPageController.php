<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;
use App\Models\Layanan;
use App\Models\Portofolio;
use App\Models\Kreator;

class LandingPageController extends Controller
{
    public function index()
    {
        $profil      = ProfilPerusahaan::first();
        $layanan     = Layanan::all();
        $portofolios = Portofolio::where('is_active', 1)->latest()->get();
        $kreator     = Kreator::latest()->get();

        return view('landing.index', compact('profil', 'layanan', 'portofolios', 'kreator'));
    }
}