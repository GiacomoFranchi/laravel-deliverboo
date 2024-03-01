

@extends('layouts.admin')

@section('content')

   

<div class="container">

    {{-- @dump($restaurantData->restaurant) --}}

    <div class="container">
        <div class="row">
            <h2>Statistics</h2>
            <hr>
            <h5>Restaurants Owned:</h5>
                <p> {{$totalRestaurantsOwned}}</p>
            <h5>Total Orders:</h5>
            <p> {{$totalOrderCount}}</p>
            <hr>
            @foreach ($restaurantsData as $restaurant)
            <div class="col">
                <h4>{{$restaurant->id}} {{ $restaurant->name }}</h4>
                <p>Total Orders: {{ $restaurant->total_orders }}</p>
                <p>Total Revenue: € {{ $restaurant->total_revenue }}</p>
                <a href="{{ route('admin.restaurants.statistics.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary">Details</a> 
            </div>
                       
            @endforeach
            

        </div>
    </div>

    <canvas id="restaurantsChart"></canvas>  



    

</div>

    
@endsection

@section('scripts')

    <script>

        window.restaurantsData = @json($restaurantsData);
        window.totalRestaurantsOwned= @json($totalRestaurantsOwned);
    </script>
    @vite(['resources/js/mychart.js'])

@endsection