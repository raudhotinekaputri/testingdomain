<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Produk</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        h1 {
            text-align: center;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Daftar Produk UMKM Patikraja</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Pemilik</th>
                <th>Alamat</th>
                <th>WhatsApp</th>
                <th>Nama Olshop</th>
                <th>Sosial Media</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $produk->judul }}</td>
                    <td>{{ strip_tags($produk->deskripsi) }}</td>
                    <td>{{ $produk->nama_pemilik }}</td>
                    <td>{{ $produk->alamat }}</td>
                    <td>{{ $produk->whatsapp }}</td>
                    <td>{{ $produk->link_olshop ?? 'Tidak ada' }}</td>
                    <td>{{ $produk->link_sosmed ?? 'Tidak ada' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
