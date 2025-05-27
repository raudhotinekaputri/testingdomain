<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email Anda</title>
</head>
<body>
    <h2>Halo {{ $user->email }}</h2>
    <p>Terima kasih telah mendaftar! Untuk menyelesaikan pendaftaran, klik tombol di bawah untuk memverifikasi email Anda.</p>
    <a href="{{ $actionUrl }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Verifikasi Email</a>
</body>
</html>
