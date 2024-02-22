@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 justify-content-center">

                <h2 class="mb-4"> Order Number {{ $order->id }}</h2>
                {{-- @foreach ($order->food_items as $food_item)
                    <p>Restaurant ID: {{ $food_item->restaurant->id }}</p>
                @endforeach --}}

                <hr>

                <ul>
                    <li class="mt-4 fs-5">
                        <span class="fw-bold ">Restaurant ID:</span>
                         {{ $order->food_items->first()->restaurant_id }}
                    </li>
                    <li class="mt-4 fs-5">
                        <span class="fw-bold ">Name:</span>
                        {{ $order->customers_name }}
                    </li>
                    <li class="mt-4 fs-5">
                        <span class="fw-bold ">Email:</span>
                        {{ $order->customers_email }}
                    </li>
                    <li class="mt-4 fs-5">
                        <span class="fw-bold ">Address:</span>
                        {{ $order->customers_address }}
                    </li>
                    <li class="mt-4 fs-5 mb-4">
                        <span class="fw-bold ">Telephone number:</span>
                        {{ $order->customers_phone_number }}
                    </li>
                </ul>
                
                <hr>

                <h3 class="mt-4 mb-3">Elements:</h3>
                <ul>
                    @foreach ($order->food_items as $food_item)
                        <li class="fw-bold">{{ $food_item->name }} - Quantity: {{ $food_item->pivot->quantity }} - Price
                            {{ $food_item->price }} € </li>
                    @endforeach
                </ul>

                <hr>

                <h5 class="mb-4">TOTAL : {{ $order->total_price }} € </h5>

                <div class="btn-wrapper mt-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Back</a>

                    <a href="{{ route('admin.orders.edit', ['order' => $order->slug]) }}" class="btn btn-warning">
                        Update</a>
                </div>
            </div>
        </div>
    </div>
@endsection
