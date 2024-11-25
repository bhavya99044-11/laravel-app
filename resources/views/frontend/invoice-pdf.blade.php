<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: white; margin: 0; padding: 0; }
        .container { width: 100%; max-width: 600px; background-color: white; margin: auto; padding: 20px; }
        .header, .total { text-align: center; padding: 10px; }
        .order-details { width: 100%; border-collapse: collapse; }
        .order-details th, .order-details td { padding: 10px; border: 1px solid #ddd; font-size: 12px; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Invoice</h1>
            <p>Order #800000025</p>
            <p>Date: {{ \Carbon\Carbon::now()->format('j F Y') }}</p>
        </div>
        <table class="order-details">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data[0]->orderItems as $item)
                <tr>
                    <td>{{ $item->ColorSize->product->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->ColorSize->size->name }}</td>
                    <td>{{ $item->ColorSize->color->color }}</td>
                    <td>${{ $item->price }}</td>
                    <td>${{ $item->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <p>gst 18%</p>
            <p><strong>Discount:</strong> -${{ $data[0]->discount}}</p>
            <p><strong>Total:</strong> ${{ $data[0]->total_price }}</p>
        </div>
    </div>
</body>
</html>
