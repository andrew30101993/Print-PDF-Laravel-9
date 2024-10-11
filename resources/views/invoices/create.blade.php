@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Create Invoice',
    'activePage' => 'invoices',
    'activeNav' => '',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Create Invoice') }}</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('invoices.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <select name="customer_id" class="form-control">
                                        <option value="">{{ __('Select Customer') }}</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'customers'])
                                </div>
                            </div>
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Number') }}</label>
                                    <input type="text" name="invoice_number" class="form-control" placeholder="Invoice Number" value="{{ $number }}" readonly>
                                    @include('alerts.feedback', ['field' => 'invoice_number'])
                                </div>
                            </div>
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Salesman Name') }}</label>
                                    <input type="text" name="salesman_name" class="form-control" placeholder="Salesman Name" value="Andrew Pete" readonly>
                                    @include('alerts.feedback', ['field' => 'salesman_name'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Date') }}</label>
                                    <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                                    @include('alerts.feedback', ['field' => 'invoice_date'])
                                </div>
                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Product') }}</th>
                                    <th>{{ __('Product Quantity') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Subtotal') }}</th>
                                    <th>{{ __('GST') }} %</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="products_table">
                                <tr>
                                    <td>
                                        <select name="products[0][id]" class="form-control product-select">
                                            <option value="">{{ __('Select Product') }}</option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="products[0][product_quantity]" class="form-control product_quantity" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="products[0][price]" class="form-control price" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="products[0][quantity]" class="form-control quantity" value="1" min="1">
                                    </td>
                                    <td>
                                        <input type="number" name="products[0][subtotal]" class="form-control subtotal" value="0" step="0.01" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="products[0][gst]" class="form-control gst" value="0" step="0.01" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="products[0][total]" class="form-control total" value="0" step="0.01" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove_product">{{ __('Remove') }}</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="add_product" class="btn btn-primary btn-round">{{ __('Add Product') }}</button>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <label>{{ __('Subtotal') }}</label>
                                <input type="number" name="invoice_subtotal" id="invoice_subtotal" class="form-control" value="0" step="0.01" readonly>
                            </div>
                            <div class="col-md-4 pr-1">
                                <label>{{ __('GST Total') }}</label>
                                <input type="number" name="invoice_gst_total" id="invoice_gst_total" class="form-control" value="0" step="0.01" readonly>
                            </div>
                            <div class="col-md-4 pr-1">
                                <label>{{ __('Grand Total') }}</label>
                                <input type="number" name="invoice_grand_total" id="invoice_grand_total" class="form-control" value="0" step="0.01" readonly>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <button type="submit" class="btn btn-primary btn-round">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let productRow = 1;

    $('#add_product').click(function() {
        const newRow = `<tr>
            <td>
                <select name="products[${productRow}][id]" class="form-control product-select">
                    <option value="">{{ __('Select Product') }}</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="products[${productRow}][product_quantity]" class="form-control product_quantity" readonly>
            </td>
            <td>
                <input type="number" name="products[${productRow}][price]" class="form-control price" readonly>
            </td>
            <td>
                <input type="number" name="products[${productRow}][quantity]" class="form-control quantity" value="1" min="1">
            </td>
            <td>
                <input type="number" name="products[${productRow}][subtotal]" class="form-control subtotal" value="0" step="0.01" readonly>
            </td>
            <td>
                <input type="number" name="products[${productRow}][gst]" class="form-control gst" value="0" step="0.01" readonly>
            </td>
            <td>
                <input type="number" name="products[${productRow}][total]" class="form-control total" value="0" step="0.01" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove_product">{{ __('Remove') }}</button>
            </td>
        </tr>`;
        $('#products_table').append(newRow);
        productRow++;
    });

    $(document).on('change', '.product-select', function() {
        const productId = $(this).val();
        const row = $(this).closest('tr');

        if (productId) {
            $.ajax({
                url: `/productlist/${productId}`,
                method: 'GET',
                success: function(data) {
                    row.find('.product_quantity').val(data.quantity);
                    row.find('.price').val(data.price);
                    const gst = data.gst; 
                    row.find('.gst').val(gst.toFixed(2));
                    calculateSubtotal(row);
                },
                error: function() {
                    alert('Error fetching product details');
                }
            });
        } else {
            row.find('.product_quantity').val('');
            row.find('.price').val('');
            row.find('.gst').val('');
            row.find('.subtotal').val('');
            row.find('.total').val('');
        }
    });

    $(document).on('input', '.quantity', function() {
        const row = $(this).closest('tr');
        calculateSubtotal(row);
    });

    $(document).on('click', '.remove_product', function() {
        $(this).closest('tr').remove();
        calculateInvoiceTotals();
    });

    function calculateSubtotal(row) {
        const quantity = parseFloat(row.find('.quantity').val()) || 0;
        const price = parseFloat(row.find('.price').val()) || 0;
        const gst = parseFloat(row.find('.gst').val()) || 0;
        const subtotal = quantity * price;
        
        row.find('.subtotal').val(subtotal.toFixed(2));
        
        const gst_total = (subtotal * (gst / 100));
        const total = subtotal + gst_total;
        
        row.find('.total').val(total.toFixed(2));

        // After updating the row's subtotal and total, recalculate the invoice totals
        calculateInvoiceTotals();
    }

    function calculateInvoiceTotals() {
        let subtotal = 0;
        let gstTotal = 0;
        let grandTotal = 0;

        // Loop through each product row in the table to calculate the totals
        $('#products_table tr').each(function() {
            const rowSubtotal = parseFloat($(this).find('.subtotal').val()) || 0;
            const gst = parseFloat($(this).find('.gst').val()) || 0;
            const gstAmount = rowSubtotal * (gst / 100); // Correct GST calculation per row
            const rowTotal = parseFloat($(this).find('.total').val()) || 0;

            subtotal += rowSubtotal;
            gstTotal += gstAmount;
            grandTotal += rowTotal;
        });

        console.log(subtotal);
        console.log(gstTotal);
        console.log(grandTotal);

        // Set the calculated values in their respective fields
        $('#invoice_subtotal').val(subtotal.toFixed(2));
        $('#invoice_gst_total').val(gstTotal.toFixed(2)); // Now reflects the actual GST amounts
        $('#invoice_grand_total').val(grandTotal.toFixed(2));
    }

</script>
@endsection
