@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Aggiungi un nuovo piatto:</h2>

        {{-- Inizio Form --}}
        <form class="mt-5" action="{{ route('admin.food_items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- NAME --}}
            <div class="mb-3" style="max-height: 250px">
                <label for="name" class="form-label">Nome Piatto</label>
                <input type="text" class="form-control" style="max-height: 250px" id="name" name="name"
                    value="{{ old('name') }}">
            </div>

            {{-- IMAGE --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine: </label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
            </div>

            {{-- PRICE --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="text" class="form-control" style="max-height: 250px" id="price" name="price"
                    value="{{ old('price') }}">
            </div>

            {{-- IS_VISIBLE --}}
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_visible" id="is_visible1">
                <label class="form-check-label" for="is_visible1">
                    Non Disponibile
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_visible" id="is_visible2" checked>
                <label class="form-check-label" for="is_visible2">
                    Disponibile
                </label>
            </div>

            <button class="btn btn-success" type="submit">Salva</button>

        </form>
    </div>
@endsection
