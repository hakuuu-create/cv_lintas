<?php
// app/Http/Controllers/LandingPageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;

class LandingPageController extends Controller
{
    public function index()
    {
        $profil = ProfilPerusahaan::first();

        return view('landing.index', compact('profil'));
    }
}