<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background-color: #d0e0ff; }
    </style>
</head>
<body>
    <h2>Data Produk</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $i => $produk)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $produk->judul }}</td>
                <td>{{ $produk->nama_pemilik }}</td>
                <td>{{ $produk->alamat }}</td>
                <td>{{ $produk->whatsapp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
