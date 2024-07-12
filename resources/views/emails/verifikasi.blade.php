<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email</title>
</head>
<body>
    <h1>Halo, {{ $name }}</h1>
    <p>Terima kasih telah mendaftar. Silakan klik tautan di bawah ini untuk memverifikasi email Anda:</p>
    <p><a href="{{ $verificationUrl }}">Verifikasi Email</a></p>
</body>
</html>