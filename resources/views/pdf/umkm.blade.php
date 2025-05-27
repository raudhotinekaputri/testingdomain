<!DOCTYPE html>
<html>
<head>
    <title>Data UMKM</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background-color: #d0f0c0; }
    </style>
</head>
<body>
    <h2>Data UMKM</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Nama Usaha</th>
                <th>Nomor HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($umkmList as $i => $umkm)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $umkm->nama_pemilik }}</td>
                <td>{{ $umkm->alamat }}</td>
                <td>{{ $umkm->judul }}</td>
                <td>{{ $umkm->whatsapp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
