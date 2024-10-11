<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        .total-row { font-weight: bold; }
        .address-section { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .address-box { width: 45%; }
    </style>
</head>
<body>
    <h1>Invoice #{{ $invoice->invoice_number }}</h1>
    <p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>

    <!-- Address Section -->
    <div class="address-section">
        <!-- Customer Address -->
        <div class="address-box">
            <h3>Customer Address</h3>
            <p><strong>{{ $invoice->customer->name }}</strong></p>
            <p>{{ $invoice->customer->address }}</p>
        </div>

        <!-- Company Address -->
        <div class="address-box">
            <h3>Company Address</h3>
            <p><strong>Test Company</strong></p> <!-- Assuming you have a $company variable -->
            <p>Address</p>
            <p>City</p>
            <p>State</p>
            <p>Country</p>

        </div>
    </div>

    <p><strong>Salesperson:</strong> {{ $invoice->salesman_name }}</p>

    <!-- Product Table -->
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>GST %</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->invoiceProducts as $product)
                <tr>
                    <td>{{ $product->product->name }}</td> <!-- Fetch product name -->
                    <td>${{ $product->price }}</td> <!-- Product price -->
                    <td>{{ $product->pur_quantity }}</td> <!-- Product quantity -->
                    <td>${{ $product->sub_total }}</td> <!-- Subtotal -->
                    <td>{{ $product->gst }}%</td> <!-- GST percentage -->
                    <td>${{ $product->total }}</td> <!-- Total -->
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3"></td>
                <td>Subtotal: ${{ $invoice->sub_total }}</td>
                <td>GST Total: ${{ $invoice->gst_total }}</td>
                <td>Grand Total: ${{ $invoice->grand_total }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
