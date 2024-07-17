<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(){

        $categoris = Category::all();
        $sub_categories = SubCategory::with('foods')->get();
        return view('layouts.chef.foods',compact('categoris','sub_categories'));
    }

    public function available($id){
        $food = Food::findOrFail($id);
        $food->update([
            'is_available' => !$food->is_available
        ]);

        return redirect()->back();
    }
}
