@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">

    </div>




    <canvas id="restaurantShowChart">


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