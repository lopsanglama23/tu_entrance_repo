<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>OTP Verification</title>
</head>
<body>
    <h2>Hello, {{ $user->first_name }}!</h2>
    <p>Thank you for registering. Your OTP (One-Time Password) is:</p>
    <h3>{{ $otp }}</h3>
    <p>This OTP will expire soon. Please do not share it with anyone.</p>
    <br>
    <p>Regards,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>

