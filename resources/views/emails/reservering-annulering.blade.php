<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Annulering van uw afspraak bij The Hair Hub</title>
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
            background: linear-gradient(135deg, #6B46C1, #0047AB);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
            border: 1px solid #eee;
            border-top: none;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
        
        h1 {
            color: white;
            margin: 0;
            font-size: 24px;
        }
        
        h2 {
            color: #6B46C1;
            margin-top: 0;
            font-size: 20px;
        }
        
        .details {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #eee;
        }
        
        .details-item {
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        .details-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .label {
            font-weight: bold;
            color: #333;
        }
        
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #6B46C1, #0047AB);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            margin-top: 15px;
            font-weight: bold;
        }
        
        .button:hover {
            background: linear-gradient(135deg, #0047AB, #6B46C1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>The Hair Hub</h1>
        </div>
        
        <div class="content">
            <h2>Bevestiging annulering afspraak</h2>
            
            <p>Beste {{ $naam }},</p>
            
            <p>Hierbij bevestigen wij dat uw afspraak bij The Hair Hub is geannuleerd. Hieronder vindt u de gegevens van de geannuleerde afspraak:</p>
            
            <div class="details">
                <div class="details-item">
                    <span class="label">Datum:</span> 
                    {{ date('d-m-Y', strtotime($datum)) }}
                </div>
                
                <div class="details-item">
                    <span class="label">Tijd:</span> 
                    {{ date('H:i', strtotime($tijd)) }} uur
                </div>
            </div>
            
            <p>Indien u een nieuwe afspraak wenst te maken, kunt u dit doen via uw klantportaal op onze website of telefonisch contact met ons opnemen.</p>
            
            <p>Wij hopen u binnenkort weer te mogen verwelkomen in onze salon.</p>
            
            <p>Met vriendelijke groet,<br>
            Team The Hair Hub</p>
            
            <a href="{{ route('klanten.index') }}" class="button">Naar uw klantportaal</a>
        </div>
        
        <div class="footer">
            <p>The Hair Hub | Kapsalon | Tel: 030-1234567 | info@thehairhub.nl</p>
            <p>© {{ date('Y') }} The Hair Hub - Alle rechten voorbehouden</p>
        </div>
    </div>
</body>
</html> 