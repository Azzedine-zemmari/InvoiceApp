<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Counter;
use App\Models\InvoiceItem;

class InvoiceController extends Controller
{
    public function index(){
        // $invoices = Invoice::all();
        $invoices = Invoice::with('customer')->orderBy('id','DESC')->get();

        return response()->json([
            'invoices'=> $invoices
        ],200);
    }
    public function search_Invoice(Request $request){
        $search = $request->get('s');
        if($search !=null){
            $invoices = Invoice::with('customer')
            ->where('id','LIKE',"%$search")
            ->get();
            return response()->json([
                "invoice"=>$invoices
            ],200);
        }
        else{
            return $this->index();
        }
    }
    public function createInvoice(){
        $counter = Counter::where('key','invoice')->first();
        $random = Counter::where('key','invoice')->first();

        $invoice = Invoice::orderBy('id','DESC')->first();
        if($invoice){
            $invoice = $invoice->id+1;
            $counters = $counter->value + $invoice;
        }
        else{
            $counters = $counter->value;
        }
        $formData = [
            'number' => $counter->prefix.$counters,
            'customer_id'=> null,
            'customer'=>null,
            'date'=> date('Y-m-d'),
            'due_date'=> null,
            'reference'=> null,
            'discount'=>0,
            'terms_and_conditions' => 'Default terms and condition',
            'items'=>[
                [
                    'product_id'=> null,
                    'product'=>null,
                    'unit_price'=>0,
                    'quantity'=>1,
                ],
            ],

        ];
        return response()->json($formData);
    }
    public function add_invoice(Request $request){
        $invoiceitem = $request->input('invoice_item');

        $invoicedata['sub_total'] = $request->input('subtotal');
        $invoicedata['total'] = $request->input('total');
        $invoicedata['number'] = $request->input('number');
        $invoicedata['date'] = $request->input('date');
        $invoicedata['due_date'] = $request->input('due_date');
        $invoicedata['discount'] = $request->input('discount');
        $invoicedata['reference'] = $request->input('reference');
        $invoicedata['terms_and_conditions'] = $request->input('terms_and_conditions');

        $invoice = Invoice::create($invoicedata);

        foreach(json_decode($invoiceitem)as $item){
            $itemdata['product_id'] = $item->id;
            $itemdata['product_id'] = $item->id;
            $itemdata['quantity'] = $item->quantity;
            $itemdata['unit_price'] = $item->unit_price;
            
            InvoiceItem::create($itemdata);

        }
    }
}