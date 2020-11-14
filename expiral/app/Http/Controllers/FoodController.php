<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{

    //TODO: Add in error handling and parameter checking

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

        //TODO: Add in checking to only delete food if the ID exists

        $deletedRows = Food::where('user_id', $id)
                        ->where('id', $food_id)    
                        ->delete();

        return response()->json(['message' => 'Food removed successfully!'], 200);
    }

    public function updateFood(Request $request) {
        $id = Auth::id();
        $food_id = $request->food_id;

        $food = Food::find($food_id);

        $food_name = $request->food_name;
        if ($food_name != "" && isset($food_name) && $food_name != null)) {
            $food->food_name = $food_name;
        }
        

        $food_upc = $request->food_upc;
        if ($food_upc != "" && isset($food_upc) && $food_upc != null)) {
            $food->food_upc = $food_upc;
        }
        

        $expiration_date = $request->expiration_date;
        if ($expiration_date != "" && isset($expiration_date) && $expiration_date != null)) {
            $food->expiration_date = $expiration_date;
        }

        $is_expired = $request->is_expired;
        if ($is_expired != "" && isset($is_expired) && $is_expired != null)) {
            $food->is_expired = $is_expired;
        }

        $food->save();

        return response()->json(['message' => 'Food updated successfully!'], 200);
    }

    public function expireFood(Request $request) {
        $id = Auth::id();
        $food_id = $request->food_id;

        $food = Food::find($food_id);

        $food->is_expired = 1;

        $food->save();

        return response()->json(['message' => 'Food expired successfully!'], 200);
    }

    public function getFood(Request $request) {
        $id = Auth::id();

        //TODO: Implement sorting feature to sort by specified column

        $food = Food::where('user_id', $id)
               ->orderBy('expiration_date', 'desc')
               ->take(10)
               ->get();

        return response()->json($food, 200);
    }
}
