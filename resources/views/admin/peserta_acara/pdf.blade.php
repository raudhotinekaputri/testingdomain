<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Peserta Acara</title>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        h2, h3 { text-align: center; }
    </style>
</head>
<body>

    <h2>Daftar Peserta Acara</h2>

    @php
        $judulAcara = optional($pesertaAcara->first()->acara)->judul ?? null;
    @endphp

    @if($judulAcara)
        <h3>{{ $judulAcara }}</h3>
        <p><strong>Acara:</strong> {{ $judulAcara }}</p>
    @else
        <h3>Daftar Semua Peserta Acara</h3>
        <p><strong>Acara:</strong> Semua Acara</p>
    @endif

    @if ($pesertaAcara->isEmpty())
        <p><strong>Catatan:</strong> Tidak ada peserta untuk acara ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesertaAcara as $peserta)
                    <tr>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->email }}</td>
                        <td>{{ $peserta->whatsapp }}</td>
                        <td>{{ $peserta->alamat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
