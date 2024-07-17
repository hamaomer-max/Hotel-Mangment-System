<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceFood;
use App\Models\SubCategory;
use App\Models\Table;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index($id){

        $table = Table::findOrFail($id);
        $categoris = Category::all();
        $sub_categories = SubCategory::with('foods')->get();
        $invoice = Invoice::where('table_id', $id)->where('status', 0)->latest()->with('invoice_foods.food.sub_category')->first();
        return view('layouts.Server.foods', compact('table','categoris','sub_categories','invoice'));
    }

    public function store(Request $request){

        if ($request->total > 0) {
            $chekForInvoice = Invoice::where('table_id', $request->table_id)->where('status', 0)->latest()->first();

            $invoice_id = -1;
            
            if ($chekForInvoice) {
                $invoice_id = $chekForInvoice->id;
            }else {
                $newInvoice =  auth()->user()->invoices()->create([
                     'table_id' => $request->table_id,
                     'total_price' => $request->total
                 ]);
                $invoice_id = $newInvoice->id;
            }
    
            for ($i=0; $i < count($request->food_id); $i++) { 
                if ($request->quantity[$i] > 0) {
                    auth()->user()->invoice_food()->create([
                        'invoice_id' => $invoice_id,
                        'food_id' => $request->food_id[$i],
                        'quantity' => $request->quantity[$i],
                        'price' => $request->price[$i],
                    ]);
                }
            }
        }

        return redirect()->back();
        }

        public function plus_or_minus($id, $value){
            $invoice_food = InvoiceFood::findOrFail($id);
            $invoice_food->update([
                'quantity' => $invoice_food->quantity + $value
            ]);

            if ($invoice_food->quantity == 0) {
                $invoice_food->delete();
            }

            return redirect()->back();
        }
}
