@extends('layouts.admin')

@section('content')

<div class="container mt-5">
     @if (Session::has('message'))
            <div class="alert alert-success">
              {{ Session::get('message') }}
            </div>
     @endif
    <div class="row">
        <div class="col-12 justify-content-center">
            
                <h2> Ordine numer {{ $order->id}}</h2>
                <p>Nome {{$order->customers_name}}</p>
                <p>Email {{$order->customers_email}}</p>
                <p>Indirizzo {{$order->customers_address}}</p>
                <p> Numero di telefono{{$order->customers_phone_number}}</p>

                 <h3>Elementi:</h3>
                <ul>
                    @foreach ($order->food_items as $food_item)
                        <li>{{ $food_item->name }} - Quantità: {{ $food_item->pivot->quantity }}</li> 
                    @endforeach
                </ul>
                
                <h6> {{ $order->total_price}}</h6>

            <div class="btn-wrapper">
                <a href="{{route('admin.orders.index')}}" class="btn btn-primary">Indietro</a>
                
                <a href="{{route('admin.orders.edit', ['order'=>$order->slug])}}" class="btn btn-warning"> Aggiorna</a>
            </div>
        </div>
    </div>
</div>
    
@endsection