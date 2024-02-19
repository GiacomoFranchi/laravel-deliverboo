@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Your Restaurants</h2>

        <div class="text-end">
            <a class="btn btn-success" href="{{ route('admin.restaurants.create') }}">
                <i class="fa-regular fa-plus"></i>
            </a>
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
                        <th scope="col" class="action-column fs-5">Actions</th>
                    </tr>
                </thead>
                <tbody class="w-100">
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <td scope="row">{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->address }}</td>
                            <td>
                                <a class="btn btn-success"
                                    href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}">
                                    Details
                                </a>

                                <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->slug]) }}"
                                class="d-inline-block" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-delete" type="submit" data-title="{{ $restaurant->name }}">
                                    Delete
                                </button>
                                <div>
                                    <a class="btn btn-primary" href="{{ route('admin.food_items.index') }}">Menu</a>
                                </div>

                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning w-50 mx-auto">
                There's nothing here yet. Add your first project.
            </div>
        @endif
    </div>

    @include('admin.restaurants.partials.delete-modal')
@endsection

@section('scripts')
    @vite(['resources/js/image-preview.js'])
@endsection
