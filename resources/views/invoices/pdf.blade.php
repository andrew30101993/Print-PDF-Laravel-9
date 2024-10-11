<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->number }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        .total-row { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Invoice #{{ $invoice->invoice_number }}</h1>
    <p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>
    <p><strong>Customer:</strong> {{ $invoice->customer->name }}</p>
    <p><strong>Salesperson:</strong> {{ $invoice->salesman_name }}</p>

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
                    <td>{{ $product->gst }}</td> <!-- GST percentage -->
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
