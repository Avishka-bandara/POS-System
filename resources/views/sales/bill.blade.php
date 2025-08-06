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

        body {
            width: 58mm;
            margin: 0 auto;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="center bold">
        Sample Shop<br>
        123 Main Street<br>
        Tel: 012-3456789
    </div>
    <hr>
    <div>Date: {{ now()->format('Y-m-d H:i') }}</div>
    <div>Invoice #: {{ $invoiceId ?? '0001' }}</div>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th class="right">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td class="right">{{ number_format($item->price * $item->qty, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <div class="bold">Total: Rs. {{ number_format($total, 2) }}</div>
    <div>Thank you! Come again!</div>
</body>

</html>
