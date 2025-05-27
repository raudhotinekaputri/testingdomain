@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>
    <form action="{{ route('user.register') }}" method="POST">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Nama:</label>
            <input type="text" name="nama" required>
        </div>
        <div>
            <label>No WhatsApp:</label>
            <input type="text" name="no_whatsapp" required>
        </div>
        <div>
            <label>Alamat:</label>
            <textarea name="alamat" required></textarea>
        </div>
        <div>
            <label>Nama Usaha:</label>
            <input type="text" name="nama_usaha" required>
        </div>
        <div>
            <label>Alamat Usaha:</label>
            <textarea name="alamat_usaha" required></textarea>
        </div>
        <div>
            <label>Kategori Usaha:</label>
            <input type="text" name="kategori_usaha">
        </div>
        <div>
            <label>Nomor Izin Usaha:</label>
            <input type="text" name="nomor_izin_usaha">
        </div>
        <div>
            <label>Nomor WhatsApp Usaha:</label>
            <input type="text" name="nomor_whatsapp_usaha" required>
        </div>
        <div>
            <label>Link Olshop 1:</label>
            <input type="text" name="link_olshop_1">
        </div>
        <div>
            <label>Link Olshop 2:</label>
            <input type="text" name="link_olshop_2">
        </div>
        <button type="submit">Register</button>
    </form>
</div>
@endsection
