@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Your Restaurants</h2>

        <div class="text-end">
            <a class="btn btn-success" href="{{ route('admin.restaurants.create') }}">
                <i class="fa-regular fa-plus"></i> Add new Restaurant
            </a>
        </div>

        <div class="text-start">
            <p>
                You own a total of <strong>{{ count($restaurants) }}</strong> restaurants.
            </p>
        </div>

        @if (Session::has('message'))
            <div class="alert alert-success w-50 mx-auto">
                {{ Session::get('message') }}
            </div>
        @endif


        @if (count($restaurants) > 0)
            <table class="table table-striped mt-5 w-100">
                <thead>
                    <tr>
                        <th scope="col" class="title-column fs-5">Name</th>
                        <th scope="col" class="description-column fs-5">Address</th>
                        <th scope="col" class="action-column fs-5">Cuisine Type</th>
                        <th scope="col" class="description-column fs-5">Menu</th>
                        <th scope="col" class="action-column fs-5">Actions</th>
                    </tr>
                </thead>
                <tbody class="w-100">
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <td scope="row">
                                <h6>{{ $restaurant->name }}</h6>
                            </td>
                            <td>{{ $restaurant->address }}</td>
                            <td>
                                @foreach ($restaurant->cusine_types as $cusine_type)
                                    <span class="badge bg-light text-dark fs-6"> {{ $cusine_type->name }} </span>
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-primary"
                                    href="{{ route('admin.restaurants.food_items.index', $restaurant->id) }}">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                                <a class="btn btn-primary" href="{{ route('admin.restaurant.orders.index', ['restaurant' => $restaurant->id]) }}">
                                    <i class="fa-solid fa-magnifying-glass">sfs</i>
                                </a>
                            </td>
                            <td>
                                {{-- show button --}}
                                <a class="btn btn-success"
                                    href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>

                                {{-- delete button --}}
                                <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->slug]) }}"
                                    class="d-inline-block" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-delete" type="submit"
                                        data-title="{{ $restaurant->name }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning w-50 mx-auto">
                There's nothing here yet. Add your first restaurant.
            </div>
        @endif
    </div>

    @include('admin.restaurants.partials.delete-modal')
@endsection

@section('scripts')
    @vite(['resources/js/image-preview.js'])
@endsection
