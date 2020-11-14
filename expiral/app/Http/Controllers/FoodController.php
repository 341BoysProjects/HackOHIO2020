<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{

    //TODO: Add in error handling and parameter checking

    /**
     * Add a food for a user
     * 
     * Adds a food item to a user with the specified parameters
     */
    public function addFood(Request $request) {
        $id = Auth::id();

        $food = new Food;

        $food->food_name = $request->food_name;
        $food->food_upc = $request->food_upc;
        $food->expiration_date = $request->expiration_date;
        $food->user_id = $id;
        $food->is_expired = 0;
        $food->past_expired = 0;
        $food->wasted_before_expiration = 0;
        $food->cost = $request->cost;

        $food->save();

        return response()->json(['message' => 'Food added successfully!'], 200);
    }

    /**
     * Remove a food
     * 
     * Remove/delete the specified food for a user
     */
    public function removeFood(Request $request) {
        $id = Auth::id();
        $food_id = $request->food_id;

        //TODO: Add in checking to only delete food if the ID exists

        $deletedRows = Food::where('user_id', $id)
                        ->where('id', $food_id)    
                        ->delete();

        return response()->json(['message' => 'Food removed successfully!'], 200);
    }

    /**
     * Update a food item for a user
     * 
     * Update a food item for a user based on the provided parameters
     */
    public function updateFood(Request $request) {
        $id = Auth::id();
        $food_id = $request->food_id;

        $food = Food::find($food_id);

        $food_name = $request->food_name;
        if ($food_name != "" && isset($food_name) && $food_name != null) {
            $food->food_name = $food_name;
        }
        

        $food_upc = $request->food_upc;
        if ($food_upc != "" && isset($food_upc) && $food_upc != null) {
            $food->food_upc = $food_upc;
        }
        

        $expiration_date = $request->expiration_date;
        if ($expiration_date != "" && isset($expiration_date) && $expiration_date != null) {
            $food->expiration_date = $expiration_date;
        }

        $is_expired = $request->is_expired;
        if ($is_expired != "" && isset($is_expired) && $is_expired != null) {
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

    /**
     * Get food for a user based on the provided user ID
     * 
     * Gets all food that belongs to a user based on the currently signed in user's ID
     */
    public function getFood(Request $request) {
        $id = Auth::id();

        //TODO: Implement sorting feature to sort by specified column

        $food = Food::where('user_id', $id)
               ->orderBy('expiration_date', 'desc')
               ->take(10)
               ->get();

        return response()->json($food, 200);
    }

    /**
     * Mark a food past its expiration date
     * 
     * This is good for when a food, such as bread, is still good past
     * its marked expiration date. This can be used to generate an idea
     * on when a food actually will expire
     */
    public function markPastExpired(Request $request) {

    }

    /**
     * Add in a user defined best by date
     * 
     * This goes along with marking a food past expired. If a food is typically
     * good two weeks past its marked expiration date, then it can be assumed
     * that there is an actual "best by" date that we can add here
     */
    public function addUserBestByDate(Request $request) {
        
    }

    /**
     * Mark a food as wasted before it expired
     * 
     * This is good for keeping track of how often and what type of food
     * is wasted by a user before it actually expires. This can help a user
     * keep track of how much food they waste and how much money they lose doing it
     */
    public function markWastedBeforeExpiration(Request $request) {

    }

    //TODO: Add in ability for user to keep track of what portion of a food they wasted, instead of the whole
    //thing, if they jsut waste half then track the half that they wasted
}
