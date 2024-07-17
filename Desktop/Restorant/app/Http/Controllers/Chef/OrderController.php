<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceFood;

class OrderController extends Controller
{
    
        public function index(){
    
          $food_invoice = InvoiceFood::where('status', '<>', 3)->
          orderby('status', 'ASC')->get();
            return view('layouts.chef.home',compact('food_invoice'));
        }
    
        public function update_status($id, $status){
    
            $invoice_food = InvoiceFood::findOrFail($id);
            $invoice_food->update([
                'status' => $status
            ]);
            return redirect()->back();
        
    }
}
