@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Aggiungi un nuovo piatto:</h2>

        {{-- Inizio Form --}}
        <form class="mt-5" action="{{ route('admin.restaurants.food_items.store',$restaurant_id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- NAME --}}
            <div class="mb-3" style="max-height: 250px">
                <label for="name" class="form-label">Nome Piatto</label>
                <input required minlength="3" maxlength="100" type="text" class="form-control @error('name') is-invalid 
                @enderror" style="max-height: 250px" id="name" name="name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            {{-- IMAGE --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine: </label>
                <input type="file" nullable accept="image/*" size="512" name="image" id="image" class="form-control @error('image') is-invalid
                @enderror">
                @error('image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea required class="form-control @error('description') is-invalid
                    
                @enderror" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            {{-- PRICE --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input required  min="0" pattern="^\d{1,3}(\.\d{1,2})?" type="text" class="form-control @error('price') is-invalid @enderror" style="max-height: 250px" id="price" name="price" value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            {{-- IS_VISIBLE --}}
            <div class="form-check">
                <input required class="form-check-input" value='0' type="radio" name="is_visible" id="is_visible1">
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

