<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Models\Food;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class FoodController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Food::query()->latest()->where('sub_category_id' , $request->sub_category)->with('user' , 'sub_category');
            return DataTables::of($data)->addIndexColumn()
                ->make(true);
        }

        $sub_categoris = SubCategory::findORFail($request->sub_category);
        return view('layouts.admin.food.index' , compact('sub_categoris'));
    }

    public function create()
    {
        
        return view('layouts.admin.food.form');
    }

    public function store(FoodRequest $request)
    {
        auth()->user()->foods()->create($request->validated());

        return redirect()->back()->with('message', 'Food created successfully');
    }

    public function edit(string $id)
    {
        $data = Food::findOrFail($id);
        return view('layouts.admin.food.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FoodRequest $request, string $id)
    {
        $old_data = Food::findOrFail($id);      

        $old_data->update($request->validated());

    return redirect()->back()->with('message', 'Data updated successfully');    
    }


    public function destroy(string $id)
    {
        Food::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
