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
            'terms_and_condition' => 'Default terms and condition',
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
    public function addInvoices(Request $request)
{
    // Validate and sanitize data as needed
    
    $invoiceitem = $request->input('invoice_item');

    $invoicedata = [
        'number' => $request->input('number'),
        'customer_id'=>$request->input('customer_id'),
        'date' => $request->input('date'),
        'due_date' => $request->input('due_date'),
        'reference' => $request->input('reference'),
        'terms_and_condition' => $request->input('terms_and_condition'),
        'sub_total'=>$request->input('sub_total'),
        'discount' => $request->input('discount'),
        'total' => $request->input('total'),
    ];

    // Create the invoice
    $invoice = Invoice::create($invoicedata);

    // Create invoice items
    foreach (json_decode($invoiceitem) as $item) {
        $itemdata = [
            'invoice_id' => $invoice->id,
            'product_id' => $item->id,
            'unit_price' => $item->unit_price,
            'quantity' => $item->quantity,
        ];

        // Create invoice item
        InvoiceItem::create($itemdata);
    }

    // Return success response
    return response()->json(['message' => 'Invoice created successfully'], 201);
}

public function showInvoice($id){
    //customer and invoice_items are a functions in invoice model
    //the invoice_items here give us the invoice item and in the invoice item there is product id using .product we can add the all the information about the product using the product_id
    $invoice = Invoice::with(['customer','invoice_items.product'])->find($id);
    return response()->json([
        'invoice'=>$invoice
    ],200);
}
public function editInvoice($id){
    $invoice = Invoice::with(['customer','invoice_items.product'])->find($id);
    return response()->json([
        'invoice'=>$invoice
    ],200);
}
public function deleteInvoiceItems($id){
    $invoiceitem = InvoiceItem::findOrFail($id);
    $invoiceitem->delete();
}
public function updateInvoice(Request $request,$id){
    $invoice = Invoice::where('id',$id)->first();

    
    $invoice->sub_total = $request->subtotal;
    $invoice->total = $request->total;
    $invoice->customer_id = $request->customer_id;
    $invoice->number = $request->number;
    $invoice->date = $request->date;
    $invoice->due_date= $request->due_date;
    $invoice->discount= $request->discount;
    $invoice->reference = $request->reference;
    $invoice->terms_and_condition = $request->terms_and_condition;

    $invoice->update($request->all());
    $invoiceitem = $request->input('invoice_item');

    $invoice->invoice_items()->delete();

    foreach (json_decode($invoiceitem) as $item) {
        $itemdata = [
            'invoice_id' => $invoice->id,
            'product_id' => $item->product_id,
            'unit_price' => $item->unit_price,
            'quantity' => $item->quantity,
        ];

        // Create invoice item
        InvoiceItem::create($itemdata);
    }

}
public function deleteInvoice($id){
    $invoice = Invoice::findOrFail($id);
    $invoice->invoice_items()->delete();
    $invoice->delete();
}
}