@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>Crea nuovo ordine</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{route('admin.orders.store')}}" method="POST">
            @csrf

        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Ristorante</label>
            <select class="form-control @error('restaurant_id') is-invalid @enderror" id="restaurantSelect" name="restaurant_id">
                <option value="">Seleziona un ristorante</option>
                @foreach ($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
                @endforeach
            </select>
            @error('restaurant_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
                <label for="customers_first_name" class="form-label">Nome</label>
                <input type="text" class="form-control @error('customers_first_name') is-invalid @enderror" id="customers_first_name" name="customers_first_name" value="{{ old('customers_first_name') }}">
                @error('customers_first_name')
                <div class='invalid-feedback'> {{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="customers_last_name" class="form-label">Cognome</label>
                <input type="text" class="form-control @error('customers_last_name') is-invalid @enderror" id="customers_last_name" name="customers_last_name" value="{{ old('customers_last_name') }}">
                @error('customers_last_name')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="customers_address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control @error('customers_address') is-invalid @enderror" id="customers_address" name="customers_address" value="{{ old('customers_address') }}">
                @error('customers_address')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
             <div class="mb-3">
                <label for="customers_phone_number" class="form-label">Numero di telefono</label>
                <input type="text" class="form-control @error('customers_phone_number') is-invalid @enderror" id="customers_phone_number" name="customers_phone_number" value="{{ old('customers_phone_number') }}">
                @error('customers_phone_number')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="customers_email" class="form-label">Email</label>
                <input type="email" class="form-control @error('customers_email') is-invalid @enderror" id="customers_email" name="customers_email" value="{{ old('customers_email') }}">
                @error('customers_email')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div id="foodItemsContainer">
                @foreach ($food_items as $item)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="food_items[]" id="item{{ $item->id }}" value="{{ $item->id }}">
                    <label class="form-check-label" for="item{{ $item->id }}">
                        {{ $item->name }}
                    </label>
                </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success">Invia</button>
        </form>
        
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/restaurantSelect.js') }}"></script>
@endsection