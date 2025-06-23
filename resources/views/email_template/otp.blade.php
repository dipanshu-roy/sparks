<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>One-Time Password for Spark Olympiads</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .btn-primary {
            display: inline-block;
            font-weight: 400;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: #0d6efd;
            border: 1px solid #0d6efd;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">

        <h2 style="color: #0d6efd;">Hello {{ $user->name ?? 'User' }},</h2>
        <p style="font-size: 16px; color: #333;">Your One-Time Password (OTP) is:</p>
        <div style="font-size: 36px; font-weight: bold; color: #0d6efd; margin: 20px 0; text-align: center; letter-spacing: 6px;">
            {{ $otp }}
        </div>
        <p style="font-size: 16px; color: #555;">This OTP is valid for the next 10 minutes. Please do not share it with anyone.</p>
        <p style="font-size: 14px; color: #999; margin-top: 30px;">If you didn’t request this, you can safely ignore this email.</p>
        <hr style="margin: 30px 0; border-color: #eee;">
        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="btn-primary" style="color:white">Visit Our Website</a>
        </div>
        <p style="font-size: 12px; color: #ccc; text-align: center; margin-top: 20px;">
            &copy; {{ date('Y') }} Spark Olympiad. All rights reserved.
        </p>
    </div>

</body>
</html>
