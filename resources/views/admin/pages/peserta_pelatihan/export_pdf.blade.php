<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Peserta Pelatihan</title>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        h2, h3 { text-align: center; }
    </style>
</head>
<body>

    <h2>Daftar Peserta Pelatihan</h2>

    @if($pelatihan)
        <h3>{{ $pelatihan->judul }}</h3>
        <p><strong>Pelatihan:</strong> {{ $pelatihan->judul }}</p>
    @else
        <h3>Daftar Semua Peserta Pelatihan</h3>
        <p><strong>Pelatihan:</strong> Semua Pelatihan</p>
    @endif

    @if ($pesertaPelatihan->isEmpty())
        <p><strong>Catatan:</strong> Tidak ada peserta untuk pelatihan ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Usaha</th>
                    <th>Email</th>
                    <th>WhatsApp</th>
                    <th>Alamat</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesertaPelatihan as $peserta)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peserta->nama }}</td>
                    <td>{{ $peserta->nama_usaha ?? '-' }}</td>
                    <td>{{ $peserta->email }}</td>
                    <td>{{ $peserta->whatsapp }}</td>
                    <td>{{ $peserta->alamat }}</td>
                    <td>{{ $peserta->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>            
        </table>
    @endif

</body>
</html>
