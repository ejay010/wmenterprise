<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Contact Form Inquiry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #e4e4e7;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #007f8c;
            padding-bottom: 20px;
            margin-bottom: 24px;
        }

        .header h1 {
            margin: 0;
            color: #0a192f;
            font-size: 22px;
        }

        .badge {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0369a1;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 10px;
            border-radius: 9999px;
            margin-top: 8px;
        }

        .summary-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 18px 20px;
            margin: 18px 0;
        }

        .summary-box h3 {
            margin-top: 0;
            margin-bottom: 12px;
            color: #0a192f;
            font-size: 15px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 6px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .info-label {
            color: #64748b;
            font-weight: bold;
            width: 140px;
            display: inline-block;
        }

        .info-value {
            color: #1e293b;
            display: inline-block;
        }

        .message-content {
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-left: 4px solid #007f8c;
            border-radius: 4px;
            padding: 14px 16px;
            font-size: 13px;
            color: #1e293b;
            white-space: pre-wrap;
            line-height: 1.5;
            margin-top: 8px;
        }

        .action-buttons {
            text-align: center;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #e4e4e7;
        }

        .btn {
            display: inline-block;
            background-color: #ed6f7c;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 13px;
            margin: 4px;
        }

        .btn-secondary {
            background-color: #007f8c;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #a1a1aa;
            margin-top: 24px;
            border-top: 1px solid #f4f4f5;
            padding-top: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>WM Car Rental</h1>
            <span class="badge">Website Contact Form Submission</span>
        </div>

        <p style="font-size: 14px; margin-bottom: 16px;">
            Hello Administrator,
        </p>
        <p style="font-size: 13px; color: #475569; margin-bottom: 20px;">
            A visitor has submitted a new contact inquiry via the website form. Below are their details:
        </p>

        <!-- Sender Information -->
        <div class="summary-box">
            <h3>Contact Details</h3>
            <div style="margin-bottom: 6px;">
                <span class="info-label">Full Name:</span>
                <span class="info-value"><strong>{{ $senderName }}</strong></span>
            </div>
            <div style="margin-bottom: 6px;">
                <span class="info-label">Email:</span>
                <span class="info-value">
                    <a href="mailto:{{ $senderEmail }}" style="color: #007f8c;">{{ $senderEmail }}</a>
                </span>
            </div>
            <div style="margin-bottom: 6px;">
                <span class="info-label">Phone:</span>
                <span class="info-value">
                    @if ($senderPhone)
                        <a href="tel:{{ $senderPhone }}" style="color: #007f8c;">{{ $senderPhone }}</a>
                    @else
                        <em>Not provided</em>
                    @endif
                </span>
            </div>
            <div>
                <span class="info-label">Preferred Airport:</span>
                <span class="info-value">{{ $preferredAirport ?: 'Not specified' }}</span>
            </div>
        </div>

        <!-- Inquiry Message -->
        <div class="summary-box">
            <h3>Inquiry Message</h3>
            <div class="message-content">{{ $inquiryMessage }}</div>
        </div>

        <!-- Direct Actions -->
        <div class="action-buttons">
            <a href="mailto:{{ $senderEmail }}?subject=Re: Your inquiry with WM Car Rental" class="btn">
                Reply via Email
            </a>
            @if ($senderPhone)
                <a href="tel:{{ $senderPhone }}" class="btn btn-secondary">
                    Call Renter
                </a>
            @endif
        </div>

        <div class="footer">
            <p>WM Car Rental &bull; Rock Sound, Eleuthera, Bahamas &bull; (242) 376-1454</p>
            <p>This automated message was sent from your website's contact form.</p>
        </div>
    </div>
</body>

</html>
