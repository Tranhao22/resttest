<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function stepone(Request $request){
        return view('step_one');
    }

    public function ajax(Request $request){
        if ($request->session()->has('restaurant')) {
            $request->session()->forget('restaurant');
        }
        $jsonFilePath = public_path('dishes.json');
        $jsonData = file_get_contents($jsonFilePath);
        $data = json_decode($jsonData, true)['dishes'];

        if($request->step == 1){
            $restaurantData = [
                'mealSelect' => $request->mealSelect,
                'numberOfPeople' => $request->numberOfPeople
            ];
            $request->session()->put('restaurant', $restaurantData);

            $mealSlect = $request->session()->get('restaurant')['mealSelect'];

            $matchedRestaurants = collect($data)->filter(function ($dish) use ($mealSlect) {
                return in_array($mealSlect, $dish['availableMeals']);
            });

            $dataOptions = $matchedRestaurants->pluck('restaurant')->unique();

            $view = view('restaurant_option', compact('dataOptions'))->render();
            return response()->json($view);
        }

        if($request->step == 2){
            $restaurantData = [
                'mealSelect' => $request->mealSelect,
                'numberOfPeople' => $request->numberOfPeople,
                'restaurantSelect' => $request->restaurantSelect
            ];

            $request->session()->put('restaurant', $restaurantData);

            $mealSelect = $request->session()->get('restaurant')['mealSelect'];
            $restaurantSelect = $request->session()->get('restaurant')['restaurantSelect'];

            $matchedDishes = collect($data)->filter(function ($dish) use ($mealSelect, $restaurantSelect) {
                return in_array($mealSelect, $dish['availableMeals']) && $dish['restaurant'] === $restaurantSelect;
            });

            $dataOptions = $matchedDishes->pluck('name')->toArray();
            $view = view('restaurant_option', compact('dataOptions'))->render();
            return response()->json($view);
        }

        if($request->step == 3){
            $restaurantData = [
                'mealSelect' => $request->mealSelect,
                'numberOfPeople' => $request->numberOfPeople,
                'restaurantSelect' => $request->restaurantSelect,
                'dishData' => $request->dishData,
            ];

            $request->session()->put('restaurant', $restaurantData);

            $dataOrder = $request->session()->get('restaurant');
            $view = view('review', compact('dataOrder'))->render();
            return response()->json($view);
        }
    }

    public function submit(){
        $data = request()->session()->get('restaurant');
        dd(['message' => 'Data saved successfully', 'data' => $data]);
    }
}
