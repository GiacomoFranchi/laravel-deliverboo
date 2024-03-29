@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="order text-center">Orders</h2>

        {{-- NEW ORDER BUTTON --}}
        {{-- <div class="text-end mt-4">
            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary" id="newOrderBtn">
                <i class="fa-solid fa-plus"></i>
                Simulate New Order </a>
        </div> --}}

        {{-- ORDERS COUNT --}}
        <div class="text-start">
            <p>
                A total of <strong>{{ count($orders) }}</strong> orders archieved.
            </p>
        </div>

        {{-- FILTER FORM --}}
         <form action="{{ route('admin.orders.index', ['restaurant_id' => $restaurantId]) }}" method="GET">
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

            <button type="submit" class="btn btn-warning filter">Filter</button>
        </form> 

        {{-- ORDERS TABLE --}}
        <div class="p-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Created: </th>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email Address</th>
                        <th scope="col">Address</th>
                        <th scope="col">Total Price </th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row"># {{ $loop->count - $loop->iteration + 1 }}</th>
                            <td>{{ $order->order_time->format('Y-m-d H:i') }}</td>
                            <td>
                                @if (count($order->food_items) > 0)
                                    <strong><p>{{ $order->food_items[0]->restaurant->name }}</p></strong>
                                @endif
                            </td>
                            <td>{{ $order->customers_name }}</td>
                            <td><strong>{{ $order->customers_email }}</strong></td>
                            <td>{{ $order->customers_address }}</td>
                            <td><strong> € {{ $order->total_price }}</strong></td>
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

