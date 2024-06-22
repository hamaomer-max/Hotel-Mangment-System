<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Table;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Table::query()->latest()->with('user');
            return DataTables::of($data)->addIndexColumn()
                ->make(true);
        }

        return view('layouts.admin.tables.index');
    }

    public function create()
    {
        
        return view('layouts.admin.tables.form');
    }

    public function store(TableRequest $request)
    {
        $new_data = $request->validated();

        auth()->user()->tables()->create($new_data);

        return redirect()->back()->with('message', 'Table created successfully');
    }

    public function edit(string $id)
    {
        $data = Table::findOrFail($id);
        return view('layouts.admin.tables.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TableRequest $request, string $id)
    {
        $old_data = Table::findOrFail($id);      

        $old_data->update($request->validated());

    return redirect()->back()->with('message', 'Data updated successfully');    
    }


    public function destroy(string $id)
    {
        Table::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
