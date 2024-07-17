<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    

    public function index(Request $request)
    {
        if ($request->ajax()) {
        $data = User::query()->latest()->with('user');
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

        return view('layouts.admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        auth()->user()->users()->create($request->validated());
        return redirect()->back()->with('message', 'User created successfully');
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
        $data = User::findOrFail($id);
        return view('layouts.admin.users.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
       $userData = $request->validated();

    if ($request->filled('password')) {
        $userData['password'] = bcrypt($request->password);
    } else {
        unset($userData['password']); // Remove password field from update if not provided
    }

    User::findOrFail($id)->update($userData);

    return redirect()->back()->with('message', 'User updated successfully');
    }


    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }

}
