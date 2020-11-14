<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{

    public function addFood(Request $request) {
        $id = Auth::id();

        $food = new Food;

        $food->food_name = $request->food_name;
        $food->food_upc = $request->food_upc;
        $food->expiration_date = $request->expiration_date;
        $food->user_id = $id;
        $food->is_expired = 0;

        $food->save();

        return response()->json(['message' => 'Food added successfully!'], 200);
    }

    public function removeFood(Request $request) {
        $id = Auth::id();
        $food_id = $request->food_id;

        $deletedRows = App\Models\Food::where('user_id', $id)
                ->where('id', $food_id)    
                ->delete();

        return response()->json(['message' => 'Food removed successfully!'], 200);
    }

    public function updateFood(Request $request) {
        $id = Auth::id();


        return response()->json(['message' => 'Food updated successfully!'], 200);
    }

    public function expireFood(Request $request) {
        $id = Auth::id();


        return response()->json(['message' => 'Food expired successfully!'], 200);
    }

    public function getFood(Request $request) {
        $id = Auth::id();

        $food = Food::where('user_id', $id)
               ->orderBy('expiration_date', 'desc')
               ->take(10)
               ->get();

        return response()->json($food, 200);
    }
}
