<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\CusineType;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $restaurants = Restaurant::where('user_id', '=', Auth::user()->id)->get();
        $cusinetypes = CusineType::all();
        return view('admin.restaurants.index', compact('restaurants', 'cusinetypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $cusinetypes = CusineType::all();
        return view('admin.restaurants.create', compact('cusinetypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        $form_data = $request->validated();
        $restaurant = new Restaurant();
        $restaurant->fill($form_data);

        if ($request->hasFile('image')) {
            $path = Storage::put('restaurants_images', $request->image);
            $restaurant->image = $path;
        }

        $restaurant->user_id = Auth::id();
        
        $restaurant->save();
        
        if ($request->has('cusinetypes')) {
            $restaurant->cusine_types()->attach($request->cusinetypes);
        }

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $cusinetypes = CusineType::all();
        return view('admin.restaurants.edit', compact('restaurant', 'cusinetypes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $form_data = $request->validated();

        if ($request->hasFile('image')) {
            if ($restaurant->image) {
                Storage::delete($restaurant->image);
            }

            $path = Storage::put('restaurants_images', $request->image);
            $form_data['image'] = $path;
        }
        
        $restaurant->update($form_data);

        if ($request->has('cusinetypes')) {
            $restaurant->cusine_types()->sync($request->cusinetypes); // sync() va a sincronizzare i nuovi dati da salvare con i dati ottenuti dal $request
        } else {
            $restaurant->cusine_types()->sync([]);
        }

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        $restaurant->delete();
        
        if ($restaurant->image) {
            Storage::delete($restaurant->image);
        }

        return redirect()->route('admin.restaurants.index')->with('message', 'The restaurant "' . $restaurant->name . '" has been deleted');
    }
}

