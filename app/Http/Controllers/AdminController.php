<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin'); // Cek apakah sudah login sebagai admin
    }

    public function index()
    {
        return view('admin.dashboard'); // Pastikan kamu punya file view-nya juga
    }

}
