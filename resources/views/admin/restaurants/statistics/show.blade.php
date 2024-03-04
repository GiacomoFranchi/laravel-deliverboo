@extends('layouts.admin')

@section('content')

<div class="container">
        <h2>
            Statistics:
        </h2>
    <div class="row d-flex mt-3">
         <div class="text-end">
            <a class="btn btn-outline-secondary" href="{{ route('admin.restaurants.statistics.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        
        <div class="col">
            <h3> {{$restaurant->name}}</h3>

            <p>Total Orders: {{ $statistics->total_orders }}</p>
            <p>Total Revenue: €{{ number_format($statistics->total_revenue, 2) }}</p>
        </div>
        <div class="col">
             <h3>Most Ordered Foods</h3>
            <ul class="list-group list-group-flush">
                @foreach ($mostOrderedFoods as $food)
                    <li class="list-group-item">{{ $food->name }} - Ordered {{ $food->order_count }} times - price:
                        <strong> € {{ $food->price}} </strong>
                    </li>
                @endforeach
            </ul>
        </div>
        




    </div>




    <canvas id="restaurantShowChart" class="w-50 h-50 d-flex justify-content-center text-center">


    </canvas>

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


</div>
    
@endsection