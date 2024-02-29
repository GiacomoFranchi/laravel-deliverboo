

@extends('layouts.admin')

@section('content')

   

<div class="container">
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