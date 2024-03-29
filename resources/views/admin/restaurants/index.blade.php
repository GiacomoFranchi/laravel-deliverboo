@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="resta text-center">Your Restaurants</h2>


        <div class="d-flex justify-content-between">
            <div class="mt-4">
                <p>
                    You own a total of <strong>{{ count($restaurants) }}</strong> restaurants.
                </p>
            </div>

            <div class=" mt-3">
                <a class="btn btn-success" href="{{ route('admin.restaurants.create') }}">
                    <i class="fa-regular fa-plus"></i> Add new Restaurant
                </a>
            </div>
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
                        <th scope="col" class="title-column fs-5 text-white" style="background-color: rgb(47 38 38)">Name
                        </th>
                        <th scope="col"
                            class="description-column fs-5 text-white"style="background-color: rgb(47 38 38)">Address</th>
                        <th scope="col" class="action-column fs-5 text-white"style="background-color: rgb(47 38 38)">
                            Cuisine Type</th>
                        <th scope="col"
                            class="description-column fs-5 text-white"style="background-color: rgb(47 38 38)">Menu</th>
                        <th scope="col"
                            class="description-column fs-5 text-white"style="background-color: rgb(47 38 38)">Orders</th>
                        <th scope="col" class="action-column fs-5 text-white"style="background-color: rgb(47 38 38)">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="w-100">
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <td scope="row">
                                <h6><strong>{{ $restaurant->name }}
                                    </strong></h6>
                            </td>
                            <td>{{ $restaurant->address }}</td>
                            <td class="w-25">
                                @foreach ($restaurant->cusine_types as $cusine_type)
                                    <span class="badge bg-light text-dark fs-6"> {{ $cusine_type->name }} </span>
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Restaurant's Menu"
                                    href="{{ route('admin.restaurants.food_items.index', $restaurant->id) }}">
                                    <i class="fa-solid fa-scroll" style="color: #ffffff;"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-primary"
                                    href="{{ route('admin.orders.index', ['restaurant_id' => $restaurant->id]) }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurant's Orders">
                                    <i class="fa-solid fa-file-invoice-dollar" style="color: #ffffff;"></i>
                                </a>
                            </td>
                            <td>
                                {{-- show button --}}
                                <a class="btn btn-success"
                                    href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->slug]) }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurant's Details">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>

                                {{-- delete button --}}
                                <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->slug]) }}"
                                    class="d-inline-block" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-delete" type="submit"
                                        data-title="{{ $restaurant->name }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete Restaurant">
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
    @vite(['resources/js/RestaurantsForms.js'])
@endsection
