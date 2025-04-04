<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord herstel - The Hair Hub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #6B46C1;
        }
        .content {
            padding: 20px 0;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #6B46C1, #0047AB);
            color: #ffffff !important;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(107, 70, 193, 0.3);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            width: 250px;
        }
        .button:hover {
            background: linear-gradient(135deg, #0047AB, #6B46C1);
            box-shadow: 0 6px 12px rgba(107, 70, 193, 0.5);
            transform: translateY(-2px);
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
        .note {
            font-size: 13px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">The Hair Hub</div>
        </div>
        <div class="content">
            <h2>Wachtwoord herstel</h2>
            <p>Hallo,</p>
            <p>U ontvangt deze e-mail omdat we een verzoek hebben ontvangen om uw wachtwoord te herstellen voor uw account bij The Hair Hub.</p>
            
            <p><strong>Klik op de onderstaande knop om uw wachtwoord opnieuw in te stellen:</strong></p>
            
            <div style="text-align: center;">
                <a href="{{ $actionUrl }}" class="button">Herstel wachtwoord</a>
            </div>
            
            <p>Deze link zal verlopen in {{ $expiresInMinutes }} minuten.</p>
            
            <p>Als u geen wachtwoord reset heeft aangevraagd, hoeft u geen actie te ondernemen.</p>
            
            <div class="note">
                <p><strong>Werkt de knop niet?</strong> Kopieer dan deze link en plak hem in je browser:</p>
                <a href="{{ $actionUrl }}" style="word-break: break-all;">{{ $actionUrl }}</a>
            </div>
        </div>
        <div class="footer">
            <p>Met vriendelijke groet,<br>The Hair Hub Team</p>
        </div>
    </div>
</body>
</html> 