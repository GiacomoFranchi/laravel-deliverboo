

@extends('layouts.admin')

@section('content')

   

<div class="container">

    {{-- @dump($restaurantData->restaurant) --}}

    <div class="container">

        <h2>Statistics</h2>
            <hr>
            <h5>Restaurants Owned:</h5>
                <p> {{$totalRestaurantsOwned}}</p>
            <h5>Total Orders:</h5>
            <p> {{$totalOrderCount}}</p>
            <hr>

        <div class="row row-cols-4 d-flex justify-content-start gap-4 ">
        
            @foreach ($restaurantsData as $restaurant)
            <div class="col-3 rounded mt-2 mb-2 border border-secondary pb-2">
                <h4 class="pt-3"> No {{$restaurant->id}}, {{ $restaurant->name }}</h4>
                <hr>
                <p>Total Orders: {{ $restaurant->total_orders }}</p>
                <p>Total Revenue: € {{ $restaurant->total_revenue }}</p>
                <div class="text-start">
                   <a href="{{ route('admin.restaurants.statistics.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-outline-primary mb-2 btn-sm">Details</a>  
                </div>
                
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