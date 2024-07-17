<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\subcategoryRequest;
use App\Models\Category;
use App\Traits\UploadFile;
use App\Traits\DeleteFile;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryController extends Controller
{
    use UploadFile;
    use DeleteFile;


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subcategory::query()->latest()->with('user' , 'category');
            return DataTables::of($data)->addIndexColumn()
                ->make(true);
        }

        return view('layouts.admin.subcategory.index');
    }

    public function create()
    {
        $categoris = Category::all();
        return view('layouts.admin.subcategory.form' , compact('categoris'));
    }

    public function store(subcategoryRequest $request)
    {
        $new_data = $request->validated();

        $name = $this->uploadFile($request , 'image' , 'categoris-image');

        $new_data['image'] = $name;

        auth()->user()->sub_categories()->create($new_data);

        return redirect()->back()->with('message', 'Subcategory created successfully');
    }

    public function edit(string $id)
    {
        $data = Subcategory::findOrFail($id);
        $categoris = Category::all();
        return view('layouts.admin.subcategory.form', compact('data' , 'categoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(subcategoryRequest $request, string $id)
    {
        $old_data = Subcategory::findOrFail($id);
       $userData = $request->validated();

       $name = $this->uploadFile($request , 'image' , 'categoris-image');
       
        $this->DeleteFile(public_path("categoris-image/{$name}"));
        
        
 
    $userData['image'] = $name;

    $old_data->update($userData);

    return redirect()->back()->with('message', 'Data updated successfully');    
    }


    public function destroy(string $id)
    {
        $sub_category = Subcategory::findOrFail($id);

        $this->DeleteFile(public_path("categoris-image/{$sub_category->image}"));

        $sub_category->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}