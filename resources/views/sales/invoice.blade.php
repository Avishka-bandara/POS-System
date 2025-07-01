@extends('layouts.layouts')
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
            @foreach($sale->items as $i => $item)
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
@endsection
