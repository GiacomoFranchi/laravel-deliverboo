<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFood_itemRequest;
use App\Http\Requests\UpdateFood_itemRequest;
use App\Models\Food_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Food_itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //$perPage = $request->input('per_page', 10); // More concise way to set default value
        //$food_items = Food_item::paginate($perPage);

        // $perPage = 10;
        // if($request->per_page){
        //     $perPage= $request->per_page;
        // }
        // $food_items= Food_item::all();
        // $food_items= Food_item::paginate($perPage);
        $perPage = 10;
        if ($request->per_page) {
            $perPage = $request->per_page;
        }

        // prendi il restaurant id dell'user
        $userRestaurantIds = auth()->user()->restaurants->pluck('id');

        // prendi i food item che hanno quel restaurant id 
        $food_items = Food_item::whereIn('restaurant_id',
            $userRestaurantIds
        )->paginate($perPage);

        return view('admin.food_items.index', compact('food_items'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { //prendi tutti i ristoranti dello user autenticato
        $restaurants = auth()->user()->restaurants;


        $restaurantId = $request->query('restaurant_id');
        $selectedRestaurant = null;

        // se c0è un id, trova all'interno di restaurant
        if ($restaurantId) {
            $selectedRestaurant = $restaurants->find($restaurantId);
        }

        return view('admin.food_items.create', compact('restaurants', 'selectedRestaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFood_itemRequest $request)
    {
        // dd($request->all());
        $userRestaurants = auth()->user()->restaurants;

        //controlla se user ha ristorante
        if ($userRestaurants->isEmpty()) {
            // errore se utente non ha ristorante
            return redirect()->back()->with('errore');
        }

        // da modificare; per ora, scegli primmo ristorante
        $selectedRestaurant = $userRestaurants->first();

        // valida i dati
        $form_data = $request->validated();

        // crea nuovo food item
        $food_item = new Food_item();
        $food_item->fill($form_data);

        // controlla img
        if ($request->hasFile('image')) {
            $path = Storage::put('food_image', $request->image);
            $food_item->image = $path;
        }

        // assegnare id del ristorante a food item
        $food_item->restaurant_id = $selectedRestaurant->id;

     
        $food_item->save();

        
        return redirect()->route('admin.food_items.show', ['food_item' => $food_item->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  food_item  $food_item
     * @return \Illuminate\Http\Response
     */
    public function show(Food_item $food_item)
    {
        return view('admin.food_items.show', compact('food_item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Food_item $food_item)
    {
        return view('admin.food_items.edit', compact('food_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFood_itemRequest $request, Food_item $food_item)
    {
        $form_data=$request->validated();

        if($request->hasFile('image')){
            if($food_item->image){
                Storage::delete($food_item->image);
            }
            $path= Storage::put('food_image', $request->image);
            $form_data['image'] = $path;
        }
        $food_item->update($form_data);
        
        return redirect()->route('admin.food_items.show', ['food_item' => $food_item->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food_item $food_item)
    {
        // dd($food_item);
        $food_item->delete();
        return redirect()->route('admin.food_items.index')->with('message', "Il piatto: $food_item->name è stato rimosso dal menu.");
    }
}
