@extends('layouts.layouts')

@section('title', 'Dashboard')


@vite(['resources/css/custom.scss', 'resources/js/app.js', 'resources/js/chart.js'])

@section('content')
<div class="container-fluid py-4">
    <!-- Filter Panel -->
    <!-- Quick Stats -->
    {{-- <div class="card mb-4 "> --}}
    {{-- <div class="card-header bg-primary text-white mb-3">
                <h5 class="mb-0">Current Sales</h5>
            </div> --}}
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center m-1">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1"> Sales </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalSales, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center m-1">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-success text-uppercase mb-1"> Total Orders
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center m-1">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-warning text-uppercase mb-1"> Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- </div> --}}
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Overview</h6>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Chart Area -->
                        <div class="col-xl-11 col-lg-8">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>

                        <!-- Filter Buttons (right side of chart) -->
                        <div class="col-xl-1 col-lg-4 d-flex align-items-center">
                            <div class="d-flex flex-column justify-content-center w-100">
                                <button type="button" class="btn btn-outline-primary btn-sm active mb-2 w-100"
                                    data-filter="daily">Daily</button>
                                <button type="button" class="btn btn-outline-primary btn-sm mb-2 w-100"
                                    data-filter="weekly">Weekly</button>
                                <button type="button" class="btn btn-outline-primary btn-sm mb-2 w-100"
                                    data-filter="monthly">Monthly</button>
                                <button type="button" class="btn btn-outline-primary btn-sm mb-2 w-100"
                                    data-filter="yearly">Yearly</button>
                            </div>
                        </div>
                    </div>

                    <hr>
                </div>
            </div>
        </div>
    </div>



    <!-- Sales Charts -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Need to Restock</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($needToRestock as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ url('/product/view-product?name=' . urlencode($product->name) . '&brand=' . urlencode($product->brand)) }}"
                        class="text-decoration-none">
                        {{ $product->name }}
                    </a>
                    <span class="badge bg-danger rounded-pill">{{ $product->quantity }}</span>
                </li>
                @endforeach
            </ul>
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
                            <a href="{{ route('sales.invoice', $sale->id) }}" class="btn btn-sm btn-primary "><i
                                    class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection