<div class="d-inline-block">
    <form action="{{ route('admin.food_items.destroy', ['food_item' => $food_item->slug]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" data-title="{{ $food_item->name }}" class="btn btn-danger btn-delete-food"><i class="fa-solid fa-trash-can"></i></i></button>
    </form>
</div>
