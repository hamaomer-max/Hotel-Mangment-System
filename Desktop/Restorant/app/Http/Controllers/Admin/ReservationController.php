<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Ressrevation;
use App\Models\Table;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReservationController extends Controller
{

    public function create()
    {
        
        return view('layouts.admin.reservation.form');
    }

    public function store(ReservationRequest $request)
    {
        auth()->user()->reservations()->create($request->validated());

        return redirect()->back()->with('message', 'Table reserved successfully');
    }

    public function show(Request $request, $id)
{
    if ($request->ajax()) {
        $data = Ressrevation::latest()->where('table_id', $id)->with('user');
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    $table = Table::findOrFail($id);
    return view('layouts.admin.reservation.index', compact('table'));

}



    public function edit(string $id)
    {
        $data = Ressrevation::findOrFail($id);
        return view('layouts.admin.reservation.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationRequest $request, string $id)
    {
        $old_data = Ressrevation::findOrFail($id);      

        $old_data->update($request->validated());

    return redirect()->back()->with('message', 'Data updated successfully');    
    }


    public function destroy(string $id)
    {
        Ressrevation::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
