<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubInformasi;

class SubInformasiController extends Controller
{
    public function index()
{
    $subInformasiList = SubInformasi::all();
    return view('informasi.sub-index', compact('subInformasiList'));
}

public function show($id)
{
    $subInformasi = SubInformasi::findOrFail($id);
    return view('informasi.sub-detail', compact('subInformasi'));
}
}
