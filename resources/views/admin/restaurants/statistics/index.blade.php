

@extends('layouts.admin')

@section('content')

   

<div class="container">

    <canvas id="restaurantsChart"></canvas>  



    >

</div>

    
@endsection

@section('scripts')

    <script>
        // Make the restaurantsData a global variable so it can be accessed by mychart.js
        window.restaurantsData = @json($restaurantsData);
    </script>
    @vite(['resources/js/mychart.js'])
@endsection