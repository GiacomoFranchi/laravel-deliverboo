@extends('layouts.admin')

@section('content')
    <div class="container mt-3 mb-5">
        <h2 class="text-center">Edit Restaurant Info</h2>


        <form id="form" class="mt-5 w-100"
            action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->slug]) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- Name Input --}}
            <div class="mb-4 has-validation w-100">
                <label for="title" class="form-label fw-bold">Name</label>
                <input required minlength="5" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $restaurant->name) }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Address Input --}}
            <div class="mb-4 has-validation">
                <label for="address" class="form-label fw-bold">Address</label>
                <input required minlength="5" type="text" class="form-control @error('address') is-invalid @enderror"
                    id="address" name="address" value="{{ old('address', $restaurant->address) }}">

                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- VAT Input --}}
            <div class="mb-4 has-validation">
                <label for="address" class="form-label fw-bold">VAT Number</label>
                <input required type="text" class="form-control @error('vat_number') is-invalid @enderror"
                    id="vat_number" name="vat_number" value="{{ old('vat_number', $restaurant->vat_number) }}">

                @error('vat_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone Number Input --}}
            <div class="mb-4 has-validation">
                <label for="phone_number" class="form-label fw-bold">Phone Number</label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                    name="phone_number" value="{{ old('phone_number', $restaurant->phone_number) }}">

                @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Time Input --}}
            <div class="d-flex gap-2">
                {{-- Opening Time Input --}}
                <div class="mb-4 has-validation w-25">
                    <label for="opening_time" class="form-label fw-bold">Opening Time</label>
                    <input type="time" class="form-control @error('opening_time') is-invalid @enderror" id="opening_time"
                        name="opening_time" value="{{ old('opening_time', $restaurant->opening_time) }}">

                    @error('opening_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Closing Time Input --}}
                <div class="mb-4 has-validation w-25">
                    <label for="closing_time" class="form-label fw-bold">Closing Time</label>
                    <input type="time" class="form-control @error('closing_time') is-invalid @enderror" id="closing_time"
                        name="closing_time" value="{{ old('closing_time', $restaurant->closing_time) }}">

                    @error('closing_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Closure Day Input --}}
                <div class="mb-3 has-validation">
                    <label for="closure_day" class="form-label fw-bold">Select closure day:</label>
                    <select class="form-select @error('closure_day') is-invalid @enderror" name="closure_day"
                        id="closure_day">
                        @foreach (['None', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ strtolower($day) }}"
                                {{ old('closure_day') == strtolower($day) || $restaurant->closure_day == $day ? 'selected' : '' }}>
                                {{ $day === 'None' ? 'No closure day' : $day }}
                            </option>
                        @endforeach
                    </select>

                    @error('closure_day')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- IMAGE EDIT INPUT FILE --}}
            <div class="mb-3">
                <label for="image" class="fw-bold">Select new image:</label>
                <div class="d-flex gap-2">
                    <input type="file" class="form-control w-50" id="image" name="image">
                    <button id="delete-img-btn" class="btn btn-danger" type="button">Remove</button>
                </div>
            </div>


            <div class="m-2 mx-auto w-100">
                <p class="fw-bold">Image preview:</p>
                <img id="preview-img" src="{{ asset('storage/' . $restaurant->image) }}" alt=""
                    style="max-height: 250px">
            </div>

            {{-- CHECKBOX FOR CUISINE TYPES --}}
            <div class="mb-3">
                <h4>Modify the Cuisine Types of your restaurant:</h4>
                @foreach ($cusine_types as $cusine_type)
                    <div class="form-check form-check-inline">
                        <input @checked(
                            $errors->any()
                                ? in_array($cusine_type->id, old('cusine_types', []))
                                : $restaurant->cusine_types->contains($cusine_type)) type="checkbox" id="cusine_type-{{ $cusine_type->id }}"
                            class="@error('cusine_types') is-invalid @enderror" value="{{ $cusine_type->id }}"
                            name="cusine_types[]">
                        <label for="cusine_type-{{ $cusine_type->id }}">{{ $cusine_type->name }}</label>
                    </div>
                @endforeach

                @error('cusine_types')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- SUBMIT BUTTON --}}
            <button id="submitButton" class="btn btn-success mb-3" type="submit">Save</button>

        </form>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/RestaurantsForms.js'])
@endsection
