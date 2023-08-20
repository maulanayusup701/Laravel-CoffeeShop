@extends('layouts.main')
@section('content')
    <div id="app">
        @include('layouts.components.sidebar')
        @include('layouts.components.navbar')
        <div id="main">
            <div class="page-heading">
                <h3>{{ $title }}</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Sub total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @if (empty($cart) || count($cart) == 0)
                                        <tbody>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data</td>
                                            </tr>
                                        </tbody>
                                    @else
                                        <tbody>
                                            @php
                                                $grandtotal = 0;
                                            @endphp
                                            @foreach ($cart as $c => $val)
                                                @php
                                                    $subtotal = $val['price'] * $val['quantity'];
                                                    $grandtotal += $subtotal;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if (!empty($val['image_url']))
                                                            <img src="{{ $val['image_url'] }}" alt="Product Image">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </td>
                                                    <td class="text-bold-500">{{ $val['product_name'] }}</td>
                                                    <td>Rp {{ number_format($val['price'], 2, ',', '.') }}</td>
                                                    <td>{{ $val['quantity'] }}</td>
                                                    <td>Rp {{ number_format($subtotal, 2, ',', '.') }}</td>
                                                    <td>
                                                        <a href="/dashboard/cashier/deleteCart/{{ $c }}"
                                                            class="btn btn-sm btn-danger">Hapus</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="5" class="text-end">Grand Total :</th>
                                                <th>Rp {{ number_format($grandtotal, 2, ',', '.') }}</th>
                                                <th>
                                                    <a href="{{ route('cashier-addTransaction') }}"
                                                        class="btn btn-sm btn-success">Checkout</a>
                                                </th>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
