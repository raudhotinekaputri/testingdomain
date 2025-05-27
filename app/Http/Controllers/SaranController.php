<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saran;

class SaranController extends Controller
{
    public function index()
    {
        return view('saran.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'isi'   => 'required|string|max:1000',
        ]);

        Saran::create([
            'email'   => $request->email,
            'isi'     => $request->isi,
            'is_read' => false,
        ]);

        return back()->with('success', 'Terima kasih atas sarannya!');
    }
}
