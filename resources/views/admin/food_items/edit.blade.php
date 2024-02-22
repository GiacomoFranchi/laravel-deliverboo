@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Edit dish:</h2>

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
        <form
            action="{{ route('admin.restaurants.food_items.update', [$food_item->restaurant_id, 'food_item' => $food_item->slug]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- NOME PIATTO --}}
            <div class="mb-3">
                <label for="name" class="form-label">Plate Name:</label>
                <input type="text" required minlength="3" maxlength="100"
                    class="form-control @error('name') is-invalid
                    
                @enderror"
                    id="name" name="name" value="{{ old('name', $food_item->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- IMMAGINE --}}
            <div class="mb-3">
                <label for="image" class="form-label">Image of the dish:</label>
                <input type="file" nullable accept="image/*" size="512" name="image" id="image"
                    class="form-control @error('image') is-invalid
                    
                @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- DESCRIZIONE --}}
            <div class="mb-3">
                <label for="description" class="form-label">Plate Description:</label>
                <textarea required class="form-control @error('description') is-invalid
                    
                @enderror"
                    name="description" id="description" rows="5">{{ old('description', $food_item->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- PRICE --}}
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" required  min="0" pattern="^\d{1,3}(\.\d{1,2})?"
                    class="form-control @error('price') is-invalid
                    
                @enderror"
                    style="max-height: 250px" id="price" name="price" value="{{ old('price', $food_item->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- DISPONIBILITA --}}
            <div class="form-check">
                <input class="form-check-input" value='0' type="radio" name="is_visible" id="is_visible1">
                <label class="form-check-label" for="is_visible1">
                    Non Available
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="is_visible" id="is_visible2" checked>
                <label class="form-check-label" for="is_visible2">
                   Available
                </label>
            </div>

            <div class="mb-3">
                <img id="preview-img" src="" alt="" style="max-height: 250px">
            </div>

            <button class="btn btn-success" type="submit">Save</button>

        </form>


    </div>
@endsection

@section('scripts')
    @vite(['resources/js/image-preview.js'])
@endsection
