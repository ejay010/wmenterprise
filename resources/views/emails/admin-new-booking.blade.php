<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Rental Booking Notification</title>
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
            font-size: 22px;
        }

        .badge {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0369a1;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 4px;
            margin-top: 6px;
        }

        .summary-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }

        .summary-box h3 {
            margin-top: 0;
            color: #18181b;
            font-size: 16px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }

        .summary-row {
            margin-bottom: 8px;
        }

        .summary-row strong {
            color: #0f172a;
            display: inline-block;
            width: 140px;
        }

        .btn {
            display: inline-block;
            background-color: #18181b;
            color: #ffffff !important;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
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
            <h1>New Rental Booking Alert</h1>
            <span class="badge">Order #{{ $order->id }}</span>
        </div>

        <p>Hello Admin,</p>
        <p>A new customer booking has just been submitted on the platform. Below are the booking details:</p>

        <div class="summary-box">
            <h3>Vehicle & Schedule</h3>
            <div class="summary-row"><strong>Vehicle:</strong> {{ $agreement->vehicle->year }} {{ $agreement->vehicle->make }} {{ $agreement->vehicle->model }} (Plate: {{ $agreement->vehicle->license_plate ?? 'N/A' }})</div>
            <div class="summary-row"><strong>Pick-up:</strong> {{ $agreement->pickup_date }} at {{ $agreement->pickup_time }}</div>
            <div class="summary-row"><strong>Pick-up Location:</strong> {{ $agreement->pickup_location }}</div>
            <div class="summary-row"><strong>Return:</strong> {{ $agreement->return_date }} at {{ $agreement->return_time }}</div>
            <div class="summary-row"><strong>Return Location:</strong> {{ $agreement->return_location }}</div>
            <div class="summary-row"><strong>Total Due:</strong> ${{ number_format($agreement->total_due, 2) }} USD</div>
            <div class="summary-row"><strong>Payment Method:</strong> {{ $agreement->payment_type }}</div>
        </div>

        <div class="summary-box">
            <h3>Customer Details</h3>
            <div class="summary-row"><strong>Renter Name:</strong> {{ $agreement->first_name }} {{ $agreement->last_name }}</div>
            <div class="summary-row"><strong>Email:</strong> <a href="mailto:{{ $agreement->email }}">{{ $agreement->email }}</a></div>
            <div class="summary-row"><strong>Phone:</strong> <a href="tel:{{ $agreement->phone }}">{{ $agreement->phone }}</a></div>
            <div class="summary-row"><strong>Driver's License:</strong> {{ $agreement->drivers_license }}</div>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('admin.agreements.index') }}" class="btn">View in Admin Portal</a>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} W Major Enterprises Admin Notification System.</p>
        </div>
    </div>
</body>

</html>
