<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .footer {
            margin-top: 30px;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Order Received</h1>

        <p>You just got a new order. Check your Admin Panel Controll for more information</p> <br>


        <ul>
            <li style="margin-bottom: 0.75rem;">
                <strong>Name:</strong> {{ $order->customers_name }}
            </li>
            <li style="margin-bottom: 0.75rem;">
                <strong>Email:</strong> {{ $order->customers_email }}
            </li>
            <li style="margin-bottom: 0.75rem;">
                <strong>Address:</strong> {{ $order->customers_address }}
            </li>
            <li style="margin-bottom: 0.75rem;">
                <strong>Phone Number:</strong> {{ $order->customers_phone_number }}
            </li>
        </ul>

        <h2>Order Summary:</h2>
        <ul>
            @foreach($order->food_items as $food_item)
            <li>{{ $food_item->name }}</span></li>
            @endforeach
        </ul>

        <strong>Total:</strong> {{ $order->total_price }} €


        <div class="footer">
            <p>Thank you,</p>
            <p>DeliveBoo Team</p>
        </div>
    </div>
</body>

</html>