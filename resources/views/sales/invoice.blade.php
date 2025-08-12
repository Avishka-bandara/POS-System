<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Bill</title>
    <style>
        @page {
            size: 58mm auto;
            /* Thermal receipt width */
            margin: 0;
        }

        @media print {
            body {
                font-family: 'Courier New', monospace;
                font-size: 12px;
                width: 58mm;
                margin: 0;
                padding: 4px;
            }

            .bill-header {
                text-align: center;
                margin-bottom: 4px;
                line-height: 1.3;
            }

            .bill-header .shop-name {
                font-size: 14px;
                font-weight: bold;
                margin-bottom: 2px;
            }

            hr {
                border: none;
                border-top: 1px dashed #000;
                margin: 4px 0;
            }

            .row {
                display: flex;
                justify-content: space-between;
                line-height: 1.2;
            }

            table.items {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
            }

            table.items th,
            table.items td {
                padding: 1px 0;
                word-wrap: break-word;
            }

            table.items th.left,
            table.items td.left {
                text-align: left;
            }

            table.items th.center,
            table.items td.center {
                text-align: center;
            }

            table.items th.right,
            table.items td.right {
                text-align: right;
            }

            /* Set fixed widths so columns align perfectly */
            table.items th:nth-child(1),
            table.items td:nth-child(1) {
                width: 30%;
            }

            table.items th:nth-child(2),
            table.items td:nth-child(2) {
                width: 20%;
            }

            table.items th:nth-child(3),
            table.items td:nth-child(3) {
                width: 18%;
            }

            table.items th:nth-child(4),
            table.items td:nth-child(4) {
                width: 12%;
            }

            table.items th:nth-child(5),
            table.items td:nth-child(5) {
                width: 20%;
            }

            .totals {
                margin-top: 4px;
            }

            .totals .row {
                font-weight: bold;
            }

            .center {
                text-align: center;
            }

            .thankyou {
                margin-top: 4px;
            }
        }

        body {
            background: #fff;
        }
    </style>
</head>

<body>
    <div class="bill-header">
        <div class="shop-name">Sample Shop</div>
        <div>123 Main Street</div>
        <div>Tel: 012-3456789</div>
    </div>

    <hr>

    <div class="row">
        <span>Date:</span>
        <span>{{ $date }}</span>
    </div>
    <div class="row">
        <span>Invoice #:</span>
        <span>{{ $sale->first()->sale->invoice_number ?? 'Invalid' }}</span>
    </div>

    <hr>

    <table class="items">
        <thead>
            <tr>
                <th class="left">Item</th>
                <th class="left">Brand</th>
                <th class="right">Unit</th>
                <th class="center">Qty</th>
                <th class="right">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale as $item)
            <tr>
                <td class="left">{{ $item->product->name }}</td>
                <td class="left">{{ $item->product->brand }}</td>
                <td class="right">{{ number_format($item->product->price, 1) }}</td>
                <td class="center">{{ $item->sale_quantity }}</td>
                <td class="right">{{ number_format($item->sale_price * $item->sale_quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <div class="totals">
        <div class="row bold">
            <span>Total:</span>
            <span>Rs. {{ number_format($sale->first()->sale->grand_total, 2) }}</span>
        </div>
        <div class="row bold">
            <span>Paid:</span>
            <span>Rs. {{ number_format($sale->first()->sale->paid, 2) }}</span>
        </div>
        <div class="row bold">
            <span>Balance:</span>
            <span>Rs. {{ number_format($sale->first()->sale->balance, 2) }}</span>
        </div>
    </div>

    <div class="center thankyou">Thank you! Come again!</div>

    <hr>

    <script>
        window.onload = function() {
            window.print();
            window.onafterprint = function() {
                window.location.href = "/sales";
            };
        };
    </script>
</body>


</html>