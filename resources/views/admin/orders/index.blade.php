@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mt-5">Your Orders </h2>

        <div class="text-start mt-4 ms-1">
            <p>
                Total orders: <strong>{{ count($orders) }}</strong>
            </p>
        </div>


        <div class="text-end mt-4">
            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary" id="newOrderBtn"> Create a new Order </a>
        </div>

        <div class="p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">restaurant_id</th>
                        <th scope="col">Client's name</th>
                        <th scope="col">Email </th>
                        <th scope="col">Address</th>
                        <th scope="col">Total price </th>
                        <th scope="col">State</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>
                                <p>{{ $order->food_items[0]->restaurant_id }}</p>
                            </td>
                            <td>{{ $order->customers_name }}</td>
                            <td>{{ $order->customers_email }}</td>
                            <td>{{ $order->customers_address }}</td>
                            <td>{{ $order->total_price }} € </td>
                            <td><a class="btn btn-success"
                                    href="{{ Route('admin.orders.show', ['order' => $order->slug]) }}"> Details </a> </td>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
        </div>
    </div>
@endsection
