@extends('layouts.admin')

@section('content')

<div class="container">

     
     <div class="text-end mt-4">
        <a href="{{ route('admin.orders.create')}}" class="btn btn-primary" id="newOrderBtn"> Create a new Order </a>
    </div>

     <div class="p-5">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">restaurant_id</th>
            <th scope="col">Nome Cliente</th>
             <th scope="col">email </th>
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
                    <td>
                        <p>{{ $order->food_items[0]->restaurant_id}}</p>
                    </td>
                    <td>{{$order->customers_name}}</td>
                    <td>{{$order->customers_email}}</td>
                    <td>{{$order->customers_address}}</td>
                    <td>{{$order->total_price}}</td>
                    <td><a class="btn btn-success" href="{{Route('admin.orders.show', ['order' => $order->slug])}}"> Dettagli </a> </td>
                    </td>

                </tr>
                
            @endforeach
            
        </tbody>
    </div>
</div>

    
@endsection