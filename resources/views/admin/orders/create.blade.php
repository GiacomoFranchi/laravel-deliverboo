{{-- @extends('layouts.admin')

@section('content')

    <div class="container">
        <h1 class="mt-3 mb-3">Create a new Order</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="form" action="{{ route('admin.orders.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="restaurant_id" class="form-label">Restaurant</label>
                <select class="form-control @error('restaurant_id') is-invalid @enderror" id="restaurantSelect"
                    name="restaurant_id">
                    <option value="">Select a restaurant</option>

                    @foreach ($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}"
                            {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
                    @endforeach

                </select>
                @error('restaurant_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="customers_name" class="form-label">Name</label>
                <input type="text" class="form-control @error('customers_name') is-invalid @enderror" id="customers_name"
                    name="customers_name" value="{{ old('customers_name') }}">
                @error('customers_first_name')
                    <div class='invalid-feedback'> {{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="customers_address" class="form-label">Address</label>
                <input type="text" class="form-control @error('customers_address') is-invalid @enderror"
                    id="customers_address" name="customers_address" value="{{ old('customers_address') }}">
                @error('customers_address')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="customers_phone_number" class="form-label">Telephone number</label>
                <input type="text" class="form-control @error('customers_phone_number') is-invalid @enderror"
                    id="customers_phone_number" name="customers_phone_number" value="{{ old('customers_phone_number') }}">
                @error('customers_phone_number')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="customers_email" class="form-label">Email</label>
                <input type="email" class="form-control @error('customers_email') is-invalid @enderror"
                    id="customers_email" name="customers_email" value="{{ old('customers_email') }}">
                @error('customers_email')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div id="foodItemsContainer">
                @foreach ($food_items as $item)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="food_items[]" id="item{{ $item->id }}"
                            value="{{ $item->id }}">
                        <label class="form-check-label" for="item{{ $item->id }}">
                            {{ $item->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button id="submitButton" type="submit" class="btn btn-success">Save</button>
        </form>

    </div>

    <script type="text/javascript">
        let oldFoodItems = @json(old('food_items', []));
    </script>

@endsection --}}
