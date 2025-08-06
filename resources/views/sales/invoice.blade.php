{{-- @extends('layouts.layouts')
@section('title', 'Invoice')

@section('content')
    <div class="container mt-4">
    <h3 class="text-center">Invoice #{{ $sale->id }}</h3>
    <p>Date: {{ $sale->created_at->format('d M Y h:i A') }}</p>
    <p>Customer: {{ $sale->customer_name ?? 'Walk-in' }}</p>
    <p>Payment Method: {{ ucfirst($sale->payment_method ?? 'cash') }}</p>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price (LKR)</th>
                <th>Total (LKR)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->items as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->sale_quantity }}</td>
                <td>{{ number_format($item->sale_price, 2) }}</td>
                <td>{{ number_format(($item->sale_price*$item->sale_quantity),2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Grand Total:</th>
                <th>LKR {{ number_format($sale->grand_total, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print me-1"></i> Print</button>
    </div>
</div>
@endsection --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Bill</title>
    <style>
        @media print {
            body {
                width: 58mm;
                font-size: 12px;
                font-family: 'Courier New', monospace;
            }

            .no-print {
                display: none;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                text-align: left;
                padding: 2px 0;
            }

            .center {
                text-align: center;
            }

            .bold {
                font-weight: bold;
            }

            hr {
                border: none;
                border-top: 1px dashed #000;
            }

        }

        .bill-header {
            text-align: center;
            font-size: 20px;
        }

        body {
            width: 58mm;
            margin: 0 auto;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="center bold bill-header">
        <div><strong>Sample Shop</strong></div>
        <div>123 Main Street</div>
        <div>Tel: 012-3456789</div>
    </div>
    <hr>
    <div>Date: {{ $date }}</div>
    <div>Invoice #: {{ $sale->first()->sale->invoice_number ?? 'Invalid' }}</div>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Brand</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th class="right">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->brand }}</td>
                    <td>{{ $item->product->price }}</td>
                    <td>{{ $item->sale_quantity }}</td>
                    <td class="right">{{ number_format($item->sale_price * $item->sale_quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <div class="bold">Total: Rs. {{ number_format($sale->first()->sale->grand_total, 2) }}</div>
    {{-- <div class="bold">Cash: Rs. {{ number_format($payment, 2) }}</div> --}}
    {{-- <div class="bold">Balance: Rs. {{ number_format($balance, 2) }}</div> --}}
    <div>Thank you! Come again!</div>
    <hr>


    <script>
        window.onload = function() {
            window.print();

            // Optional: after printing, redirect back to POS or dashboard
            window.onafterprint = function() {
                window.location.href = "/sales"; // or your desired route
            };
        };
    </script>

</body>

</html>
