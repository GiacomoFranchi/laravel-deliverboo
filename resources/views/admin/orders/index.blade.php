@extends('layouts.admin')

@section('content')

<div class="container">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome Cliente</th>
            <th scope="col">Cognome cliente</th>
            <th scope="col">Indirizzo</th>
            <th scope="col">Totale </th>
            <th scope="col">Stato </th>
            <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
               <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->customer_first_name}}</td>
                    <td>{{$order->customer_last_name}}</td>
                     <td>{{$order->customer_email}}</td>
                    <td>{{$order->customer_address}}</td>
                    <td>{{$order->total_price}}</td>
                    </td>

                </tr>
                
            @endforeach
            
        </tbody>
    
</div>

    
@endsection