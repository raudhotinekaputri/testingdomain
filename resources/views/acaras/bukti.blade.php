@extends('layouts.app')

@section('title', 'Bukti Pendaftaran')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bukti Pendaftaran</div>
                <div class="card-body">
                    <h3>Pendaftaran Anda Berhasil!</h3>
                    <p>Berikut adalah bukti pendaftaran Anda:</p>

                    <table class="table">
                        <tr>
                            <th>ID Pendaftaran</th>
                            <td>{{ $peserta->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Acara</th>
                            <td>{{ $acara->judul }}</td>
                        </tr>
                        <tr>
                            <th>Nama Peserta</th>
                            <td>{{ $peserta->nama }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $peserta->email }}</td>
                        </tr>
                        <tr>
                            <th>Whatsapp</th>
                            <td>{{ $peserta->whatsapp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $peserta->alamat }}</td>
                        </tr>
                    </table>

                    <p>Terima kasih telah mendaftar. Kami akan menghubungi Anda melalui email atau WhatsApp untuk informasi lebih lanjut.</p>
                    
                    <a href="{{ route('acaras.index') }}" class="btn btn-primary">Kembali ke Daftar Acara</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
