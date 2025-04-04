<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wachtwoord gewijzigd bij The Hair Hub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background-color: #6B46C1;
            color: white;
            padding: 15px;
            text-align: center;
        }
        
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #eee;
        }
        
        .alert {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 15px 0;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>The Hair Hub</h1>
        </div>
        
        <div class="content">
            <h2>Wachtwoord gewijzigd</h2>
            
            <p>Beste {{ $naam }},</p>
            
            <p>We willen u laten weten dat het wachtwoord voor uw account bij The Hair Hub zojuist is gewijzigd.</p>
            
            <div class="alert">
                <p>Als u deze wijziging niet zelf heeft doorgevoerd, neem dan direct contact met ons op.</p>
            </div>
            
            <p>Details van de wijziging:</p>
            <ul>
                <li><strong>Tijdstip:</strong> {{ date('d-m-Y H:i') }}</li>
                <li><strong>E-mailadres:</strong> {{ $email }}</li>
            </ul>
            
            <p>Met vriendelijke groet,<br>
            Team The Hair Hub</p>
        </div>
        
        <div class="footer">
            <p>The Hair Hub | Kapsalon | Tel: 030-1234567</p>
            <p>Dit is een automatisch gegenereerd bericht, antwoord niet op deze e-mail.</p>
        </div>
    </div>
</body>
</html> 