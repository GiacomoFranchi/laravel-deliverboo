@extends('layouts.admin')

@section('content')

<div class="container mt-3">
    <div class="d-flex  fle-row justify-content-between">
        <h2 class="stat">
            Statistics:
        </h2>

        <a class="btn btn-warning" href="{{ route('admin.restaurants.statistics.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Back
        </a>

    </div>
        
    <div class="row mt-5">
        
        
        <div class="col-lg-5 col-md-12 col-sm-12 mb-2">
            <h3 class="stat text-center"> {{$restaurant->name}}</h3>

            <p><strong>Total Orders:</strong> {{ $statistics->total_orders }}</p>
            <p><strong>Total Revenue:</strong> €{{ number_format($statistics->total_revenue, 2) }}

            <h3 class="mt-3 mb-3 stat">Most Ordered Foods</h3>
            <ul class="list-group list-group-flush border">
                @foreach ($mostOrderedFoods as $food)
                    <li class="list-group-item"><strong class="badge text-dark p-2">{{ $food->name }}</strong> - Ordered {{ $food->order_count }} times - price:
                        <strong> € {{ $food->price}} </strong>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">

            <canvas id="restaurantShowChart">


            </canvas>

        </div>
        
    </div>

    

</div>
    

    @section('scripts')

        <script>

           
        window.restaurant = @json($restaurant);
        window.statistics= @json($statistics);
        window.mostOrderedFoods= @json($mostOrderedFoods);
        const mostOrderedFoodsLabels = {!! json_encode($mostOrderedFoods->pluck('name')) !!};
        const mostOrderedFoodsData = {!! json_encode($mostOrderedFoods->pluck('order_count')) !!};
        </script>
        @vite(['resources/js/showChart.js'])
        
    @endsection



    
@endsection