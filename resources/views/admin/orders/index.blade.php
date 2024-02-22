@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Orders</h2>

        {{-- NEW ORDER BUTTON --}}
        <div class="text-end mt-4">
            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary" id="newOrderBtn">
                <i class="fa-solid fa-plus"></i>
                Simulate New Order </a>
        </div>

        {{-- ORDERS COUNT --}}
        <div class="text-start">
            <p>
                A total of <strong>{{ count($orders) }}</strong> orders archieved.
            </p>
        </div>

        {{-- FILTER FORM --}}
        <form class="row" action="{{ route('admin.orders.index', ['restaurant_id' => $restaurantId]) }}" method="GET">
            <div class="mb-3">
                <label for="restaurantFilter" class="form-label"><strong>Filter your orders by Restaurant:</strong></label>
                <select class="form-select @error('restaurant_id') is-invalid @enderror" name="restaurant_id"
                    id="restaurant">
                    <option value="">Show All</option>
                    @foreach ($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}" {{ $restaurantId == $restaurant->id ? 'selected' : '' }}>
                            {{ $restaurant->name }}
                        </option>
                    @endforeach
                </select>
                @error('restaurant_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        {{-- ORDERS TABLE --}}
        <div class="p-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Orders ID</th>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email Address</th>
                        <th scope="col">Address</th>
                        <th scope="col">Total Price </th>
                        <th scope="col">Status </th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>
                                @if ($order->restaurant)
                                    <p>{{ $order->restaurant->name }}</p>
                                @endif
                            </td>
                            <td>{{ $order->customers_name }}</td>
                            <td>{{ $order->customers_email }}</td>
                            <td>{{ $order->customers_address }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td> - </td>
                            <td>
                                <a class="btn btn-success"
                                    href="{{ route('admin.orders.show', ['order' => $order->slug]) }}">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
        </div>
    </div>
@endsection
