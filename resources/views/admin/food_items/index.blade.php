@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>Menu Ristorante</h2>

    <div class="text-end">
        <a class="btn btn-success" href="{{ route('admin.food_items.create') }}">Aggiungi Piatto</a>
    </div>

    @if (count($food_items) > 0)
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Data Aggiunta</th>
                    <th scope="col">Disponibile</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($food_items as $food_item)
                    <tr>
                        <th scope="row">{{ $food_item->id }}</th>
                        <td>{{ $food_item->name }}</td>
                        <td>{{ $food_item->created_at }}</td>
                        <td>{{ $food_item->is_visible }}</td>
                        <td>
                            <a href="{{ route('admin.food_items.show', ['project' => $project->slug]) }}"
                                class="btn btn-primary">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>

                            <a class="btn btn-warning"
                                href="{{ route('admin.food_items.edit', ['project' => $project->slug]) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>

                            @include('admin.food_items.partials.delete_button')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning mt-5 text-center">
            Aggiungi i tuoi Piatti e li visualizzerai qui!
        </div>
    @endif
    <div>
        {{ $food_items->links() }}
    </div>

</div>



@endsection
