

@extends('layouts.admin')

@section('content')

   

<div class="container">

    {{-- @dump($restaurantData->restaurant) --}}

    <div class="container mt-4">

        <h2 class="stat text-center">Statistics</h2>

            <hr class="bord">

            <h5 class="resta-own"><strong>Restaurants Owned:</strong>
                <p class="badge text-dark ms-2"> {{$totalRestaurantsOwned}}</p>
            </h5>
            
            <h5 class="tot-ord"><strong>Total Orders:</strong>
                <p class="badge text-dark ms-2"> {{$totalOrderCount}}</p>
            </h5>
            
            <h5 class="tot-rev"><strong>Total revenue across all restaurants:</strong>
                <strong class="badge text-dark ms-2">€{{ number_format($totalRevenueAll, 2) }}</strong>
            </h5>

            <hr class="bord"> 

        <div class="row row-cols-4 d-flex justify-content-start gap-4 mb-4">
        
            @foreach ($restaurantsData as $restaurant)
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 rounded mt-2 mb-2 border pb-2">
                <h4 class="pt-3 name-rest text-center mt-2"> <strong> No {{$restaurant->id}}, {{ $restaurant->name }} </strong></h4>

                <hr class="bord">

                <p class="badge p-2 text-dark"> <strong>Total Orders: </strong> {{ $restaurant->total_orders }}</p>
                <p class="badge p-2 text-dark"> <strong>Total Revenue:</strong>  €  {{ $restaurant->total_revenue }}</p>
                <div class="text-start">
                   <a href="{{ route('admin.restaurants.statistics.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-warning mb-2 btn-sm">Details</a>  
                </div>
                
            </div>
                       
            @endforeach
            

        </div>
    </div>

    <div class="chart-container justify-content-center align-items-center " style="position: relative; height:40vh; width:80vw">

        <canvas id="restaurantsChart"></canvas>  

    </div>
   



    

</div>

    
@endsection

@section('scripts')

    <script>

        window.restaurantsData = @json($restaurantsData);
        window.totalRestaurantsOwned= @json($totalRestaurantsOwned);
    </script>
    @vite(['resources/js/mychart.js'])

@endsection