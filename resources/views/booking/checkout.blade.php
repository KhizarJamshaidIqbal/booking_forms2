<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desert Excursion Checkout</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .checkout-title {
            color: #15BFBF;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .checkout-section {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .checkout-section h2 {
            margin-top: 0;
            color: #333;
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .checkout-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        }
        .checkout-item:last-child {
            border-bottom: none;
        }
        .item-name {
            flex: 3;
        }
        .item-quantity {
            flex: 1;
            text-align: center;
        }
        .item-price {
            flex: 1;
            text-align: right;
            font-weight: bold;
        }
        .checkout-total {
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
            text-align: right;
            margin-top: 20px;
        }
        .total-label {
            font-size: 18px;
            color: #333;
            margin-right: 10px;
        }
        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #15BFBF;
        }
        .customer-details {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
        .checkout-button {
            background-color: #15BFBF;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        .checkout-button:hover {
            background-color: #14adad;
        }
        .booking-summary {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .summary-label {
            font-weight: 600;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container" x-data="checkoutData()">
        <h1 class="checkout-title">Booking Checkout</h1>

        <div class="checkout-section">
            <h2>Booking Summary</h2>
            <div class="booking-summary">
                <div class="summary-item">
                    <span class="summary-label">Date:</span>
                    <span>{{ $bookingData['date'] }}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Time Slot:</span>
                    <span>{{ $bookingData['time_slot'] }}</span>
                </div>
            </div>

            <h2>Selected Items</h2>
            @foreach($selectedItems as $item)
            <div class="checkout-item">
                <div class="item-name">{{ $item['name'] }}</div>
                <div class="item-quantity">{{ $item['quantity'] ?? 1 }}</div>
                <div class="item-price">AED {{ $item['price'] }}</div>
            </div>
            @endforeach

            @if(!empty($bookingData['comments']))
            <h2>Comments</h2>
            <p>{{ $bookingData['comments'] }}</p>
            @endif

            <div class="checkout-total">
                <span class="total-label">Total:</span>
                <span class="total-amount">AED {{ $totalPrice }}</span>
            </div>
        </div>

        <div class="checkout-section">
            <h2>Customer Details</h2>
            <form action="{{ route('desert-excursion.complete') }}" method="POST">
                @csrf

                <!-- Pass the booking data as hidden fields -->
                @foreach($bookingData as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $subKey => $subValue)
                            <input type="hidden" name="{{ $key }}[{{ $subKey }}]" value="{{ $subValue }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                <div class="form-group">
                    <label for="name" class="required-field">Full Name</label>
                    <input type="text" id="name" name="customer_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email" class="required-field">Email Address</label>
                    <input type="email" id="email" name="customer_email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone" class="required-field">Phone Number</label>
                    <input type="tel" id="phone" name="customer_phone" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="customer_nationality" class="form-control">
                </div>

                <button type="submit" class="checkout-button">Complete Booking</button>
            </form>
        </div>
    </div>

    <script>
        function checkoutData() {
            return {
                init() {
                    // Any initialization logic here
                }
            }
        }
    </script>
</body>
</html>
