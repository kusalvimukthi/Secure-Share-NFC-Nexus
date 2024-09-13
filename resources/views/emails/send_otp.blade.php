<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your OTP to access the Smart Wallet from Share NFC Nexus.">
    <title>Your OTP Code - Share NFC Nexus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
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
            font-size: 24px;
        }
        .email-body {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-body p {
            font-size: 18px;
            color: #333333;
            margin-bottom: 10px;
        }
        .otp-code {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin: 20px 0;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
            margin-top: 20px;
        }
        /* Responsive tweaks */
        @media (max-width: 600px) {
            .email-header h2 {
                font-size: 22px;
            }
            .otp-code {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h2>Welcome to Share NFC Nexus!</h2>
    </div>
    <div class="email-body">
        <p>To access your Smart Wallet, use the OTP code below:</p>
        <p class="otp-code">{{ $otp }}</p>
        <p>Please enter this OTP within the next 2 minutes to ensure secure access to your Smart Wallet.</p>
    </div>
    <div class="email-footer">
        <p>&copy; 2024 Share NFC Nexus. All rights reserved.</p>
    </div>
</div>
</body>
</html>
