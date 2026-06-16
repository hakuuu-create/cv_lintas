<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;
use App\Models\Portofolio;
use App\Models\Creator;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil data profil perusahaan baris pertama
        $profil = ProfilPerusahaan::first();
        $creator = Creator::first();
        $portofolios = Portofolio::where('is_active', 1)
            ->latest()
            ->take(3)
            ->get();

        return view('landing.index', compact('profil', 'portofolios', 'creator'));
    }

    public function detailPortofolio($id)
    {
        $profil = ProfilPerusahaan::first();
        $portofolios = Portofolio::where('id')->firstOrFail();

        return view('landing.detail_kegiatan', compact('profil', 'portofolios'));
    }
}