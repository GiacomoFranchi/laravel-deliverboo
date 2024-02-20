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
    public function index($restaurant_id)
    {

        $food_items= Food_item::where('restaurant_id', $restaurant_id)->get();
        
        return view('admin.food_items.index', compact('food_items','restaurant_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($restaurant_id)
    {
        return view('admin.food_items.create', compact('restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFood_itemRequest $request, $restaurant_id)
    {
        $form_data = $request->validated();
        $food_item = new Food_item();
        $food_item->restaurant_id = $restaurant_id;
        $food_item->fill($form_data);


       //controllo se c'è img e aggiungo al db
       if($request->hasFile('image')){
        $path = Storage::put('food_image', $request->image);
        $food_item->image = $path;   
        }
        $food_item->save();
        return redirect()->route('admin.restaurants.food_items.index' , $restaurant_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  food_item  $food_item
     * @return \Illuminate\Http\Response
     */
    public function show($restaurant_id, Food_item $food_item)
    {
        return view('admin.food_items.show', compact('food_item' , 'restaurant_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($restaurant_id,Food_item $food_item)
    {
        return view('admin.food_items.edit', compact('food_item' , 'restaurant_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFood_itemRequest $request, $restaurant_id, Food_item $food_item)
    {
        $form_data=$request->validated();
        $food_item->restaurant_id = $restaurant_id;

        if($request->hasFile('image')){
            if($food_item->image){
                Storage::delete($food_item->image);
            }
            $path= Storage::put('food_image', $request->image);
            $form_data['image'] = $path;
        }
        $food_item->update($form_data);

        $food_item->restaurant_id = $restaurant_id;
        $food_item->fill($form_data);

        
        return redirect()->route('admin.restaurants.food_items.show', [$food_item->restaurant_id, 'food_item' => $food_item->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($restaurant_id, Food_item $food_item)
    {

        $food_item->delete();
        return redirect()->route('admin.restaurants.food_items.index', $restaurant_id)

        ->with('message', "Il piatto: $food_item->name è stato rimosso dal menu.");
    }
}
