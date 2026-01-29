<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni İletişim Formu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #5b1022;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #5b1022;
            display: block;
            margin-bottom: 5px;
        }
        .field-value {
            background: white;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ddd;
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
    <div class="header">
        <h1>Yeni İletişim Formu</h1>
    </div>
    
    <div class="content">
        <div class="field">
            <span class="field-label">Ad Soyad:</span>
            <div class="field-value">{{ $contact->name }}</div>
        </div>
        
        <div class="field">
            <span class="field-label">E-posta:</span>
            <div class="field-value">{{ $contact->email }}</div>
        </div>
        
        <div class="field">
            <span class="field-label">Telefon:</span>
            <div class="field-value">{{ $contact->phone }}</div>
        </div>
        
        <div class="field">
            <span class="field-label">Doğum Tarihi:</span>
            <div class="field-value">{{ $contact->birth_date->format('d.m.Y') }}</div>
        </div>
        
        <div class="field">
            <span class="field-label">Program Türü:</span>
            <div class="field-value">{{ $contact->program_type }}</div>
        </div>
        
        <div class="field">
            <span class="field-label">Dil Programı:</span>
            <div class="field-value">{{ $contact->language }}</div>
        </div>
        
        @if($contact->message)
        <div class="field">
            <span class="field-label">Mesaj:</span>
            <div class="field-value">{{ $contact->message }}</div>
        </div>
        @endif
        
        <div class="field">
            <span class="field-label">Gönderim Tarihi:</span>
            <div class="field-value">{{ $contact->created_at->format('d.m.Y H:i') }}</div>
        </div>
    </div>
    
    <div class="footer">
        <p>Bu e-posta AKAĞİTİM web sitesinden otomatik olarak gönderilmiştir.</p>
    </div>
</body>
</html>
