<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceFood;
use App\Models\SubCategory;
use App\Models\Table;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class TableController extends Controller
{
    
    public function index()
    {
        $data = Table::all(); 
        $orders = Invoice::all();
       return view('layouts.Server.home', compact('data' , 'orders'));
    }

    public function destroy($id)
    {
        $table = Invoice::findOrFail($id)->delete();
        return redirect('/server/home');
    }

    public function delete_orders($id)
    {
        InvoiceFood::findOrFail($id)->delete();
        return redirect()->back();
    }

}
