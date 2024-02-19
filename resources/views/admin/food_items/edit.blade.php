@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Modifica piatto:</h2>

        {{-- Messaggi errore di Validazione --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Inizio Form --}}
        <form action="{{ route('admin.restaurants.food_items.update', ['food_item' => $food_item->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- NOME PIATTO --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Piatto:</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $food_item->name) }}">
            </div>

            {{-- IMMAGINE --}}
            <div class="mb-3">
                <label for="image" class="form-label">Foto Pietanza:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            {{-- DESCRIZIONE --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione Piatto:</label>
                <textarea class="form-control" name="description" id="description" rows="5">{{ old('description', $food_item->description) }}</textarea>
            </div>

            {{-- PRICE --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo:</label>
                <input type="text" class="form-control" style="max-height: 250px" id="price" name="price"
                    value="{{ old('price', $food_item->price) }}">
            </div>

            {{-- DISPONIBILITA --}}
            <div class="form-check">
                <input class="form-check-input" value='0' type="radio" name="is_visible" id="is_visible1">
                <label class="form-check-label" for="is_visible1">
                    Non Disponibile
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="is_visible" id="is_visible2" checked>
                <label class="form-check-label" for="is_visible2">
                    Disponibile
                </label>
            </div>

            <div class="mb-3">
                <img id="preview-img" src="" alt="" style="max-height: 250px">
            </div>
            
            <button class="btn btn-success" type="submit">Salva</button>

        </form>


    </div>
@endsection

@section('scripts')
    @vite(['resources/js/image-preview.js'])
@endsection
