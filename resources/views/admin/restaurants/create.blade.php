@extends('layouts.admin')

@section('content')
    <div class="container mt-3 mb-5 w-50">
        <h2 class="text-center">Add New Project</h2>

        <form class="mt-5" action="" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Name Input --}}
            <div class="mb-4 has-validation">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Address Input --}}
            <div class="mb-4 has-validation">
                <label for="address" class="form-label fw-bold">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" value="{{ old('address') }}">

                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- VAT Number Input --}}
            <div class="mb-4 has-validation">
                <label for="vat_number" class="form-label fw-bold">VAT Number</label>
                <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number"
                    name="vat_number" value="{{ old('vat_number') }}">

                @error('vat_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone Number Input --}}
            <div class="mb-4 has-validation">
                <label for="phone_number" class="form-label fw-bold">Phone Number</label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                    name="phone_number" value="{{ old('phone_number') }}">

                @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Time Input --}}
            <div class="d-flex gap-2">
                {{-- Opening Time Input --}}
                <div class="mb-4 has-validation w-25">
                    <label class="form-label fw-bold" for="opening_time">Opening Time</label>
                    <input type="time" class="form-control @error('opening_time') is-invalid @enderror" id="opening_time"
                        name="opening_time" value="{{ old('opening_time') }}"">
    
                    @error('opening_time')
                        <div class="invalid-feedback">{{ $message }}
                        </div>
                    @enderror
                </div>
    
                {{-- Closing Time Input --}}
                <div class="mb-4 has-validation w-25">
                    <label class="form-label fw-bold" for="closing_time">Closing Time</label>
                    <input type="time" class="form-control @error('closing_time') is-invalid @enderror" id="closing_time"
                        name="closing_time" value="{{ old('closing_time') }}">
    
                    @error('closing_time')
                        <div class="invalid-feedback">{{ $message }}
                        </div>
                    @enderror
                </div>
    
                {{-- Address Input --}}
                <div class="mb-4 has-validation w-50">
                    <label for="closure_day" class="form-label fw-bold">Select closure day:</label>
                    <select class="form-select @error('closure_day') is-invalid @enderror" name="closure_day" id="closure_day">
                        <option @selected(!old('closure_day')) value="none">No closure day</option>
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="aaturday">Saturday</option>
                        <option value="aunday">Sunday</option>
                    </select>
    
                    @error('type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="mb-4">
                <label for="image" class="form-label fw-bold">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">

                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
