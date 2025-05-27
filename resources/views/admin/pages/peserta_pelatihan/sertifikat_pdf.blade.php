<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Pelatihan</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 50px;
        }

        body {
            font-family: 'Times New Roman', serif;
            text-align: center;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
        }

        .header {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .subheader {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .nama {
            font-size: 32px;
            font-weight: bold;
            margin: 20px 0;
            text-decoration: underline;
        }

        .desc {
            font-size: 18px;
            line-height: 1.8;
            margin: 20px 0 50px;
        }

        .footer {
            font-size: 16px;
            margin-top: 80px;
            text-align: right;
            padding-right: 60px;
        }

        .pengesahan {
            margin-top: 40px;
            text-align: left;
            padding-left: 60px;
            font-size: 16px;
        }

        .logo {
            position: absolute;
            top: 40px;
            left: 50px;
            width: 100px;
        }
    </style>
</head>
<body>

    {{-- Tambahkan logo jika diperlukan --}}
    {{-- <img src="{{ public_path('logo.png') }}" class="logo"> --}}

    <div class="header">SERTIFIKAT PELATIHAN</div>
    <div class="subheader">Diberikan kepada:</div>

    <div class="nama">{{ $peserta->nama }}</div>

    <div class="desc">
        Telah mengikuti pelatihan <strong>{{ $peserta->pelatihan->judul }}</strong><br>
        yang diselenggarakan pada:<br>
        {{ \Carbon\Carbon::parse($peserta->pelatihan->tanggal_mulai)->translatedFormat('d F Y') }}
        s.d.
        {{ \Carbon\Carbon::parse($peserta->pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}<br>
        atas nama usaha: <strong>{{ $peserta->nama_usaha ?? '-' }}</strong>
    </div>

    <div class="footer">
  Dikeluarkan pada tanggal: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
</div>


    <div class="pengesahan">
        Atas nama,<br>
        <strong>UMKM Patikraja</strong>
    </div>

</body>
</html>
