@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>
            Restaurant Menu
        </h2>

        <div class="text-end">
            <a class="btn btn-success" href="{{ route('admin.restaurants.food_items.create', $restaurant_id) }}">
                <i class="fa-solid fa-plus"></i> Add New Dish
            </a>
        </div>

        <div class="text-start">
            <p>
                You have a total of <strong>{{ count($food_items) }}</strong> dishes in your menu.
            </p>
        </div>

        {{-- start- DELETE MESSAGE --}}
        @if (session('message'))
            <div class="alert alert-success mt-4">
                {{ session('message') }}
            </div>
        @endif
        {{-- end - DELETE MESSAGE --}}

        @if (count($food_items) > 0)
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th scope="col">Dish Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col" class="text-center">Availability</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($food_items as $food_item)
                        <tr>
                            <td scope="row">{{ $food_item->name }}</td>
                            <td class="w-50">{{ $food_item->description }}</td>
                            <td>{{ $food_item->price }}€</td>
                            <td class="text-center">
                                @if ($food_item->is_visible)
                                    <p class="card-subtitle mb-2 text-muted">
                                        <i class="fa-solid fa-square-check"></i>
                                    </p>
                                @else
                                    <p class="card-subtitle mb-2 text-muted">
                                        <i class="fa-solid fa-square-xmark"></i>
                                    </p>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.restaurants.food_items.show', [$food_item->restaurant_id, 'food_item' => $food_item->slug]) }}"
                                    class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Product's Details">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>

                                <a class="btn btn-warning"
                                    href="{{ route('admin.restaurants.food_items.edit', [$food_item->restaurant_id, 'food_item' => $food_item->slug]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Product">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>

                                @include('admin.food_items.partials.btn_delete')
                                @include('admin.food_items.partials.modal-delete')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mt-5 text-center">
                Add your Dishes and you will see them here!
            </div>
        @endif


    </div>



@endsection
