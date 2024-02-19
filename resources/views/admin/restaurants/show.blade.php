@extends('layouts.admin')

@section('content')
    <div class="container mt-3 mb-5">
        <h2 class="fs-1 mb-3">{{ $restaurant->name }}</h2>

        
        <div>
            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="">
        </div>
       

        <hr>

        <ul>
            <li class="mt-5 fs-5">
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
                
                {{ $restaurant->opening_time }}
            </li>

            <li class="mt-2 fs-5">
                <span class="fw-bold ">Closing Time:</span>
                
                {{ $restaurant->closing_time }}
            </li>

            <li class="mt-2 fs-5">
                <span class="fw-bold ">Closure Day:</span>
                
                {{ $restaurant->closure_day }}
            </li>
        </ul>


        <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->slug]) }}" class="btn btn-warning">Edit You
            Restaurant
        </a>

        {{-- <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->slug]) }}" class="d-inline-block"
            method="POST">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-delete" type="submit" data-title="{{ $restaurant->name }}">
                Delete
            </button>

        </form> --}}
    </div>

@endsection

@section('scripts')
    @vite(['resources/js/image-preview.js'])
@endsection