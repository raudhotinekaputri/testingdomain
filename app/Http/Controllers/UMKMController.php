<?php

namespace App\Http\Controllers;

use App\Models\UMKM;
use Illuminate\Http\Request;

class UMKMController extends Controller
{
    public function index()
    {
        $umkms = UMKM::all();
        return view('umkm.index', compact('umkms'));
    }

    public function show($id)
    {
        $umkm = UMKM::findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }
}
