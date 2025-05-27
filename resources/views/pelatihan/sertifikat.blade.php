<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Pelatihan</title>
    <style>
        /* Styling sertifikat */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .sertifikat {
            padding: 50px;
            border: 5px solid #000;
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        .sertifikat h1 {
            font-size: 36px;
            font-weight: bold;
        }
        .sertifikat p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="sertifikat">
        <h1>SERTIFIKAT PELATIHAN</h1>
        <p>Telah berhasil mengikuti pelatihan</p>
        <h2>{{ $pelatihan->judul }}</h2>
        <p>Nama: {{ $peserta->nama }}</p>
        <p>Nama Usaha: {{ $peserta->nama_usaha ?? '-' }}</p>
        <p>Alamat: {{ $peserta->alamat ?? '-' }}</p>
        <p>Whatsapp: {{ $peserta->whatsapp }}</p>
        <p>Email: {{ $peserta->email }}</p>
        <p>Tanggal Pelatihan: {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}</p>
    </div>
</body>
</html>
