<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilOrganisasi;

class ProfilOrganisasiController extends Controller
{
    public function index()
    {
        $profil = ProfilOrganisasi::first();
        return view('profil_organisasi.index', compact('profil'));
    }
}

