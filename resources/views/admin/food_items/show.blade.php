@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card my-4" style="width: 18rem;">
            <div class="card-body">

                {{-- Name --}}
                <h5 class="card-title">{{$food_item->name}}</h5>

                {{-- Controllo se esiste img --}}
                @if ($food_item->image)
                    <div>
                        <img style="width: 250px"  src="{{asset('storage/' .$food_item->image)}}" alt="">
                    </div>
                 @else
                 <p>Nessuna immagine caricata</p>
                @endif

                {{-- Data Creazione --}}
                <h6 class="card-subtitle mb-2 text-muted">Creato il: {{$food_item->created_at}}</h6>

                {{-- Prezzo --}}
                <h6 class="card-subtitle mb-2 text-muted">Prezzo: {{$food_item->price}}</h6>

                {{-- Descrizione --}}
                <p class="card-text">Descrizione: {{$project->content}}</p>
            </div>
        </div>


        <a class="btn btn-primary my-2" href="{{ route('admin.projects.index') }}">Indietro</a>
        @include('admin.projects.partials.delete_button')
    </div>
@endsection
