<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .success-icon {
            font-size: 80px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .success-title {
            color: #333;
            font-size: 28px;
            margin-bottom: 15px;
        }
        .success-message {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        .return-home {
            display: inline-block;
            background-color: #15BFBF;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 20px;
        }
        .return-home:hover {
            background-color: #14adad;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✓</div>
        <h1 class="success-title">Booking Successful!</h1>
        <p class="success-message">
            Thank you for your booking. We have received your request and will process it shortly.<br>
            A confirmation email has been sent to your email address with all the details of your booking.
        </p>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <p>
            If you have any questions or need further assistance, please contact us.
        </p>

        <a href="{{ route('desert-excursion.show') }}" class="return-home">Return to Home</a>
    </div>
</body>
</html>
