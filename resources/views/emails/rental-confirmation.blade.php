<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rental Booking Confirmation</title>
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
            border-bottom: 2px solid #27272a;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            color: #18181b;
            font-size: 24px;
        }

        .summary-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .summary-row strong {
            color: #0f172a;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #71717a;
            border-top: 1px solid #e4e4e7;
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Booking Confirmed!</h1>
            <p style="margin: 5px 0 0 0; color: #52525b;">Thank you for renting with W Major Enterprises</p>
        </div>

        <p>Dear {{ $agreement->first_name }} {{ $agreement->last_name }},</p>

        <p>Your rental booking has been successfully confirmed. Attached to this email is a PDF copy of your signed
            <strong>Rental Agreement (Ref #{{ $agreement->id }})</strong> for your records.</p>

        <div class="summary-box">
            <h3 style="margin-top: 0; color: #18181b;">Reservation Summary</h3>
            <p><strong>Order #:</strong> {{ $order->id }}</p>
            <p><strong>Vehicle:</strong> {{ $agreement->vehicle->year }} {{ $agreement->vehicle->make }}
                {{ $agreement->vehicle->model }}</p>
            <p><strong>Pickup:</strong> {{ $agreement->pickup_date }} at {{ $agreement->pickup_time }}
                ({{ $agreement->pickup_location }})</p>
            <p><strong>Return:</strong> {{ $agreement->return_date }} at {{ $agreement->return_time }}
                ({{ $agreement->return_location }})</p>
            <p><strong>Total Paid:</strong> ${{ number_format($agreement->total_due, 2) }} USD</p>
        </div>

        <p>If you have any questions or need to make changes to your pickup schedule, please contact our customer
            service team at any time.</p>

        <p>Safe travels,<br><strong>W Major Enterprises Team</strong></p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} W Major Enterprises. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
