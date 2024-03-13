@extends('layouts.admin')

@section('content')
    <div class="container mt-5 mb-5">
        <div>
            <div>
                <h1 class="resta text-center">Restaurant: {{$food_item->restaurant->name}}</h1>
                {{-- Name --}}
                <h2 class="fs-1 mb-3 resta-own mt-3">Dish: {{ $food_item->name }}</h2>

                {{-- Controllo se esiste img --}}
                @if ($food_item->image)
                    <div class="mb-4" style="width: 40%;">
                        <img src="{{ asset('storage/' . $food_item->image) }}" alt="">
                    </div>
                @else
                    <div class="mb-4" style="width: 40%;">
                        <img src="{{asset('storage/food_image/no_img.png')}}" alt="NO image">
                    </div>
                @endif

                <hr>

                <ul>

                    {{-- Data Creazione --}}
                    <li class="mt-4 fs-5">
                        <span class="fw-bold ">Created on: {{ $food_item->created_at->format('Y-m-d H:i') }}
                        </span>
                    </li>


                    {{-- Prezzo --}}
                    <li class="mt-2 fs-5">
                        <span class="fw-bold "> Price: {{ $food_item->price }} €
                        </span>
                    </li>

                    {{-- Descrizione --}}
                    <li class="mt-2 fs-5">
                        <span class="fw-bold "> Description: {{ $food_item->description }}
                        </span>
                    </li>
                    

                    {{-- disponibilità --}}

                    @if ($food_item->is_visible)
                        <li class="mt-2 fs-5">
                            <span class="fw-bold ">
                                Available
                            </span>
                        </li>
                    @else
                        <p class="card-subtitle mb-2 text-muted">Not available</p>
                    @endif

            </div>
            </ul>
            <div class="mt-4">
                <a class="btn btn-warning me-1"
                    href="{{ route('admin.restaurants.food_items.edit', [$food_item->restaurant_id, 'food_item' => $food_item->slug]) }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>

                <a class="btn btn-success me-1"
                    href="{{ route('admin.restaurants.food_items.index', [$food_item->restaurant_id, 'food_item' => $food_item->slug]) }}">
                    View the Menu
                </a>

                @include('admin.food_items.partials.btn_delete')
                @include('admin.food_items.partials.modal-delete')
            </div>

        </div>

    </div>
@endsection
