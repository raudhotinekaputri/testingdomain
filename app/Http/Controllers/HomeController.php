<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\UMKM;
use App\Models\Produk;
use App\Models\Acara;
use App\Models\Footer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $footer = Footer::first(); 
        
        // Ambil semua banner
        $banners = Umkm::select('banner_1', 'banner_2', 'banner_3')->get();
        
        // Ambil data UMKM pertama (pastikan data ada di DB)
        $umkmProfile = UMKM::first();

        // Ambil 3 produk terbaru
        $products = Produk::latest()->take(4)->get();

        // Ambil 3 artikel atau event terbaru
        $acaras = Acara::latest()->take(3)->get();

        // Kirim data ke view home
        return view('home', compact('banners', 'umkmProfile', 'products', 'acaras','footer'));
    }

}
