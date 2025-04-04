<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bevestiging van uw afspraak bij The Hair Hub</title>
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
            <h2>
                @if(isset($is_cancel) && $is_cancel)
                    Annulering van uw afspraak
                @elseif(isset($is_update) && $is_update)
                    Wijziging van uw afspraak
                @else
                    Bevestiging van uw afspraak
                @endif
            </h2>
            
            <p>Beste {{ $naam }},</p>
            
            <p>
                @if(isset($is_cancel) && $is_cancel)
                    Hierbij bevestigen wij dat uw afspraak bij The Hair Hub is geannuleerd.
                @elseif(isset($is_update) && $is_update)
                    Hierbij bevestigen wij de wijziging van uw afspraak bij The Hair Hub.
                @else
                    Hartelijk dank voor uw reservering bij The Hair Hub.
                @endif
            </p>
            
            <p><strong>Datum:</strong> {{ date('d-m-Y', strtotime($datum)) }}</p>
            <p><strong>Tijd:</strong> {{ date('H:i', strtotime($tijd)) }} uur</p>
            <p><strong>Medewerker:</strong> {{ $medewerker }}</p>
            
            @if(isset($is_cancel) && $is_cancel)
                <p>Indien u een nieuwe afspraak wenst te maken, kunt u dit doen via uw klantportaal op onze website.</p>
            @else
                <p>Wij verwelkomen u graag op de aangegeven datum en tijd in onze salon.</p>
            @endif
            
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