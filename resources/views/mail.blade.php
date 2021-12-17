<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Email Confirmation</title>
</head>

<body>
    <p>Selamat datang di Supermarket OnMart, silahkan klik link berikut untuk verifikasi akun anda: </p>
    <a href="https://onmart-paw.xyz/verify/{{ $detail['email'] }}/{{ $detail['password'] }}/{{ \Carbon\Carbon::parse($detail['date'])->format('Y-m-d H:i:s') }}">Konfirmasi akun anda.</a><br><br>
</body>
</html>