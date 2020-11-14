<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{

    public function addFood(Request $request) {

    }

    public function removeFood(Request $request) {

    }

    public function updateFood(Request $request) {

    }

    public function expireFood(Request $request) {

    }

    public function getFood(Request $request) {
        $id = Auth::id();
        echo $id;

        $food = Food::where('user_id', $id)
               ->orderBy('expiration_date', 'desc')
               ->take(10)
               ->get();
    }
}
