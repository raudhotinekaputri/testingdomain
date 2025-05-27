@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Saya</h2>
    @if($profile)
    <table class="table">
        <tr><th>Nama</th><td>{{ $profile->nama ?: '-' }}</td></tr>
        <tr><th>No WhatsApp</th><td>{{ $profile->no_whatsapp ?: '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $profile->alamat ?: '-' }}</td></tr>
        <tr><th>Nama Usaha</th><td>{{ $profile->nama_usaha ?: '-' }}</td></tr>
        <tr><th>Alamat Usaha</th><td>{{ $profile->alamat_usaha ?: '-' }}</td></tr>
        <tr>
            <th>Kategori Usaha</th>
            <td>
                @if($profile->kategoriUsaha->count())
                    {{ $profile->kategoriUsaha->pluck('nama')->implode(', ') }}
                @else
                    -
                @endif
            </td>            
        </tr>        
        <tr><th>Nomor Izin Usaha</th><td>{{ $profile->nomor_izin_usaha ?: '-' }}</td></tr>
        <tr><th>No WhatsApp Usaha</th><td>{{ $profile->nomor_whatsapp_usaha ?: '-' }}</td></tr>
        <tr><th>Link Olshop 1</th><td>{{ $profile->link_olshop_1 ?: '-' }}</td></tr>
        <tr><th>Link Olshop 2</th><td>{{ $profile->link_olshop_2 ?: '-' }}</td></tr>
        <tr><th>Deskripsi Usaha</th><td>{{ $profile->deskripsi_usaha ?: '-' }}</td></tr>
    </table>
    @else
        <p>Profil belum lengkap. <a href="{{ route('user.profile.edit') }}" class="btn btn-warning">Lengkapi Profil</a></p>
    @endif

    <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Edit Profil</a>
</div>
@endsection
