<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Changed - Verify Your Email</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .email-header {
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .email-header h2 {
            color: #007bff;
        }
        .email-body {
            margin-bottom: 20px;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h2>Email Change Notification</h2>
    </div>
    <div class="email-body">
        <p>Dear {{ $userName }},</p>
        <p>Your email address has been changed. To verify your new email address, please click the button below:</p>
        <div style="text-align: center;">
            <a href="{{ $link }}" class="btn btn-custom">Verify Your Email</a>
        </div>
        <p>If the button above does not work, click the link below to verify your email:</p>
        <p><a href="{{ $link }}">Click here to verify</a></p>
    </div>
    <div class="email-footer">
        <p>&copy; 2024 Share NFC Nexus. All rights reserved.</p>
    </div>
</div>
</body>
</html>
