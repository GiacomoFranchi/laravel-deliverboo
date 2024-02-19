@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card my-4" style="width: 18rem;">
            <div class="card-body">

                {{-- Name --}}
                <h5 class="card-title">{{ $food_item->name }}</h5>

                {{-- Controllo se esiste img --}}
                @if ($food_item->image)
                    <div>
                        <img style="width: 250px" src="{{ asset('storage/' . $food_item->image) }}" alt="">
                    </div>
                @else
                    <p>Nessuna immagine caricata</p>
                @endif

                {{-- Data Creazione --}}
                <h6 class="card-subtitle mb-2 text-muted">Creato il: {{ $food_item->created_at }}</h6>

                {{-- Prezzo --}}
                <h6 class="card-subtitle mb-2 text-muted">Prezzo: {{ $food_item->price }}</h6>

                {{-- Descrizione --}}
                <p class="card-text">Descrizione: {{ $food_item->description }}</p>

                {{-- disponibilità --}}

                @if ($food_item->is_visible)
                    <p class="card-subtitle mb-2 text-muted">Disponibile</p>
                @else
                    <p class="card-subtitle mb-2 text-muted">non disponibile</p>
                @endif

            </div>
            <div class="card-body">
                <a class="btn btn-warning" href="{{ route('admin.food_items.edit', ['food_item' => $food_item->slug]) }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>
    
                <a class="btn btn-success" href="{{ route('admin.food_items.index') }}">
                    View all
                </a>
                
                @include('admin.food_items.partials.btn_delete')
            </div>

        </div>

    </div>
@endsection
