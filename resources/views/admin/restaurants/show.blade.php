@extends('layouts.admin')

@section('content')
    <div class="container mt-4 mb-5">
        <h2 class="fs-1 mb-3">Restaurant : {{ $restaurant->name }}</h2>


        <div>
            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="">
        </div>


        <hr>

        <ul class="mb-5">
            <li class="mt-4 fs-5">
                <span class="fw-bold ">Address</span>
                {{ $restaurant->address }}

            </li>

            <li class="mt-2 fs-5">
                <span class="fw-bold ">VAT number:</span>

                {{ $restaurant->vat_number ? $restaurant->vat_number : 'No VAT number available' }}
            </li>

            <li class="mt-2 fs-5">
                <span class="fw-bold ">Phone Number:</span>

                {{ $restaurant->phone_number }}
            </li>

            <li class="mt-2 fs-5">
                <span class="fw-bold ">Opening Time:</span>

                {{ date('H:i', strtotime($restaurant->opening_time)) }}
            </li>

            <li class="mt-2 fs-5">
                <span class="fw-bold ">Closing Time:</span>

                {{ date('H:i', strtotime($restaurant->closing_time)) }}
            </li>

            <li class="mt-2 fs-5">
                <span class="fw-bold ">Closure Day:</span>

                {{ $restaurant->closure_day }}
            </li>

            <li class="mt-2 fs-5">
                <span class="fw-bold ">Cusine Types:</span>

                @foreach ($restaurant->cusine_types as $cusine_type)
                    <span class="badge bg-light text-dark fs-6"> {{ $cusine_type->name }} </span>
                @endforeach
            </li>
        </ul>


        <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}" class="btn btn-warning">
            <i class="fa-solid fa-pencil"></i>
        </a>

        <a class="btn btn-success" href="{{ route('admin.restaurants.index') }}">
            View Restaurants
        </a>
        <a  class="btn btn-primary" href="{{ route('admin.orders.index', ['restaurant_id' => $restaurant->id]) }}" class="btn btn-warning">
           View Orders
        </a>

        <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->slug]) }}" class="d-inline-block"
            method="POST">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-delete" type="submit" data-title="{{ $restaurant->name }}">
                <i class="fa-solid fa-trash-can"></i>
            </button>

        </form>
    </div>

    @include('admin.restaurants.partials.delete-modal')
@endsection

@section('scripts')
    @vite(['resources/js/RestaurantsForms.js'])
@endsection
