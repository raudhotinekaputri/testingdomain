<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use PDF;

class PublicExportController extends Controller
{
    public function exportUmkm()
    {
        $produks = Produk::all();
        $umkmList = $produks->unique('nama_pemilik')->values()->map(function ($item) {
            return (object)[
                'nama_pemilik' => $item->nama_pemilik,
                'alamat'       => $item->alamat,
                'judul'        => $item->judul,
                'whatsapp'     => $item->whatsapp,
            ];
        });

        $pdf = PDF::loadView('pdf.umkm', compact('umkmList'))->setPaper('a4', 'landscape');
        return $pdf->download('data_umkm.pdf');
    }

    public function exportProduk()
    {
        $produks = Produk::all();
        $pdf = PDF::loadView('pdf.produk', compact('produks'))->setPaper('a4', 'landscape');
        return $pdf->download('data_produk.pdf');
    }
}
