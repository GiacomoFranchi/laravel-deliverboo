@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card my-4" style="width: 18rem;">
            <div class="card-body">

                {{-- Name --}}
                <h5 class="card-title">{{ $food_item->name }}</h5>

                {{-- Controllo se esiste img --}}
                @if ($food_item->image)
                    <div class="mb-3">
                        <img style="width: 250px" src="{{ asset('storage/' . $food_item->image) }}" alt="">
                    </div>
                @else
                    <p>No image loaded</p>
                @endif

                {{-- Data Creazione --}}
                <h6 class="card-subtitle mb-2 text-muted">Created on: {{ $food_item->created_at }}</h6>

                {{-- Prezzo --}}
                <h6 class="card-subtitle mb-2 text-muted">Price: {{ $food_item->price }} €</h6>

                {{-- Descrizione --}}
                <p class="card-text">Description: {{ $food_item->description }}</p>

                {{-- disponibilità --}}

                @if ($food_item->is_visible)
                    <p class="card-subtitle mb-2 text-muted">Available</p>
                @else
                    <p class="card-subtitle mb-2 text-muted">Not available</p>
                @endif

            </div>
            <div class="card-body">
                <a class="btn btn-warning"
                    href="{{ route('admin.restaurants.food_items.edit', [$food_item->restaurant_id, 'food_item' => $food_item->slug]) }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>

                <a class="btn btn-success"
                    href="{{ route('admin.restaurants.food_items.index', [$food_item->restaurant_id, 'food_item' => $food_item->slug]) }}">
                    View the Menu
                </a>

                @include('admin.food_items.partials.btn_delete')
                @include('admin.food_items.partials.modal-delete')
            </div>

        </div>

    </div>
@endsection
