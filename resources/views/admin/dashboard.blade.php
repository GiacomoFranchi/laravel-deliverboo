@extends('layouts.admin')

@section('content')
<div class="wrap" style="background-color: rgb(197 170 106)">
    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header text-center fw-bold" style="background-color: rgb(242 200 2)">{{ __('Dashboard') }}</div>

                    <div class="card-body text-center text-white" style="background-color: rgb(47 38 38)">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <strong>{{ __('You are logged in!') }}</strong>

                        <div class="card text-center mt-5">
                            <div class="card-header fw-bold" style="background-color: rgb(242 200 2)">
                                Your Profile
                            </div>
                            <div class="card-body text-white" style="background-color: rgb(47 38 38)">
                                <h5 class="card-title"></h5>
                                <p class="card-text">Name: {{ auth()->user()->name }}</p>
                                <p>Last Name: {{ auth()->user()->last_name }}</p>
                                <p>
                                    Address:
                                    <span id="address-content" class="sensitive-content">
                                        **************
                                    </span>
                                    <i id="eye-slash-address" class="fas fa-eye-slash mx-1 eye-icon"></i>
                                </p>
                                <p>
                                    Email:
                                    <span id="email-content" class="sensitive-content">
                                        *************
                                    </span>
                                    <i id="eye-slash-email" class="fa-solid fa-eye-slash mx-1 eye-icon"></i>
                                </p>
                                <hr class="hr">
                                <div class="d-flex justify-content-center">
                                    <div class="mb-3 mx-2 card card-custom" style="background-color: rgb(242 200 2)">
                                        <a class="row g-0" href="{{ route('admin.restaurants.index') }}">
                                            <div class="col-md-12 text-center">
                                                <i class="fa-solid fa-utensils fa-style fa-lg fa-fw" style="color: rgb(47 38 38)"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <h5 class="card-title"><strong>Restaurants</strong></h5>
                                                    <p class="card-text"><small class="text-body-secondary">List of all your
                                                            restaurants registered. Keep track of your restaurants profiles
                                                            and Menus</small></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mb-3 mx-2 card card-custom" style="background-color: rgb(242 200 2)">
                                        <a class="row g-0" href="{{ route('admin.orders.index') }}">
                                            <div class="col-md-12 text-center">
                                                <i class="fa-solid fa-receipt fa-style fa-lg fa-fw" style="color: rgb(47 38 38)"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <h5 class="card-title"><strong>Orders</strong></h5>
                                                    <p class="card-text"><small class="text-body-secondary">List of all your orders received in your restaurants, check customer and order details.</small></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mb-3 mx-2 card card-custom" style="background-color: rgb(242 200 2)">
                                        <a class="row g-0" href="{{ route('admin.restaurants.statistics.index') }}">
                                            <div class="col-md-12 text-center">
                                                <i class="fa-solid fa-chart-simple ms-1 fa-style" style="color: rgb(47 38 38)"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <h5 class="card-title"><strong>Stats</strong></h5>
                                                    <p class="card-text"><small class="text-body-secondary">Simplified view
                                                            of your restaurants and orders stats. Easy-to-read graphs for
                                                            you need.</small></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary d-flex justify-content-between align-content-center " style="background-color: rgb(47 38 38)">
                                <button disabled class="btn btn-outline-secondary text-white">
                                    DeliveBoo
                                </button>
                                <button disabled class="btn btn-outline-secondary text-white">
                                    Support
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @vite('resources/js/dboard.js')
@endsection
