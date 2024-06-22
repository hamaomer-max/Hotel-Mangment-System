<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\UploadFile;
use App\Traits\DeleteFile;
use App\Http\Requests\categoriRequest;

class CategoryCotroller extends Controller
{

    use UploadFile;
    use DeleteFile;

    public function index(Request $request)
    {


        if ($request->ajax()) {
        $data = Category::query()->latest()->with('user');
         return DataTables::Of($data)->addIndexColumn()
         //->addColumn('action', function($row){
        //     return '<a href="'.route('admin.users.edit', ['user' => $row->id]).'" class="btn btn-sm btn-primary">Edit</a>
        //     <form id='.$row->id.' action="'.route('admin.users.destroy', ['user' => $row->id]).'" method="POST">
        //     ' . csrf_field() . '
        //     ' . method_field('DELETE') . '
        //     <button type="button" onclick="deleteFunction('.$row->id.')" class="btn btn-sm btn-danger">Delete</button>
        //     </form>
        //     ';
        // })->rawColumns(['action'])
        ->make(true);
        }

        return view('layouts.admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(categoriRequest $request)
    {
        $new_data = $request->validated();


        $new_data['image'] = $this->uploadFile($request, 'image', 'categoris-image');

        auth()->user()->categoris()->create($new_data);
        return redirect()->back()->with('message', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Category::findOrFail($id);
        return view('layouts.admin.category.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoriRequest $request, string $id)
    {
        $old_data = Category::findOrFail($id);
       $userData = $request->validated();

       $name = $old_data->image;
       
       $this->DeleteFile(public_path("categoris-image/{$name}"));
        
        
        $name = $this->uploadFile($request, 'image', 'categoris-image');
    
    $userData['image'] = $name;

    $old_data->update($userData);

    return redirect()->back()->with('message', 'Data updated successfully');    
    }


    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $this->DeleteFile(public_path("categoris-image/{$category->image}"));

        $category->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }

}


