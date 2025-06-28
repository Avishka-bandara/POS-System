@extends('layouts.layouts')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Filter Panel -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Sales Filters</h5>
        </div>
        <div class="card-body">
            <form id="filterForm" method="GET" action="{{ route('dashboard') }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="date_range">Date Range</label>
                        <input type="text" id="date_range" name="date_range" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="month">Month</label>
                        <select id="month" name="month" class="form-control">
                            <option value="">All</option>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="year">Year</label>
                        <input type="number" id="year" name="year" class="form-control" placeholder="{{ date('Y') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="product">Product</label>
                        <select id="product" name="product" class="form-control">
                            <option value="">All</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Apply Filters</button>
            </form>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h6>Total Sales</h6>
                    <h4>Rs {{ number_format($totalSales, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h6>Total Orders</h6>
                    <h4>{{ $totalOrders }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h6>Products</h6>
                    <h4>{{ $totalProducts }}</h4>
                </div>
            </div>
        </div>
       
    </div>

    <!-- Sales Charts -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Sales Overview</h5>
        </div>
        <div class="card-body">
            <canvas id="salesChart" height="120"></canvas>
        </div>
    </div>

    <!-- Top Products -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Top Selling Products</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($topProducts as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $product->name }}
                        <span class="badge bg-primary rounded-pill">{{ $product->sales_count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Recent Sales -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Recent Sales</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentSales as $sale)
                        <tr>
                            <th scope="row">{{ $sale->id }}</th>
                            <td>{{ $sale->invoice_number }}</td>
                            <td>{{ $sale->customer_name }}</td>
                            <td>Rs {{ number_format($sale->grand_total, 2) }}</td>
                            <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('sales.invoice', $sale->id) }}" class="btn btn-sm btn-primary "><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Sales',
                data: {!! json_encode($chartData) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: true,
                tension: 0.4,
                backgroundColor: 'rgba(75, 192, 192, 0.2)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Optional: use date picker (e.g., Flatpickr or jQuery UI)
</script>
@endpush
