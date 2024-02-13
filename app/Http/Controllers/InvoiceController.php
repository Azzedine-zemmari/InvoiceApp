<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index(){
        $invoices = Invoice::all();
        return response()->json([
            'invoices'=> $invoices
        ],200);
    }
}
 