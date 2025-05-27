<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data User</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Data User UMKM</h2>
    <p style="text-align: center; margin-top: -10px; margin-bottom: 20px;">
        Data dari tanggal {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} 
        sampai {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
    </p>    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Nama</th>
                <th>No. WhatsApp</th>
                <th>Alamat</th>
                <th>Nama Usaha</th>
                <th>Alamat Usaha</th>
                <th>Kategori Usaha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->profile->nama ?? '-' }}</td>
                <td>{{ $user->profile->no_whatsapp ?? '-' }}</td>
                <td>{{ $user->profile->alamat ?? '-' }}</td>
                <td>{{ $user->profile->nama_usaha ?? '-' }}</td>
                <td>{{ $user->profile->alamat_usaha ?? '-' }}</td>
                <td>
                    {{ $user->profile && $user->profile->kategori_usaha
                        ? $user->profile->kategoriUsaha->nama
                        : '-' }}
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
