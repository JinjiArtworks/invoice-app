<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceApi extends Controller
{
    public function index()
    {
        // customer ini nama function yg ada di modelnya.
        $invoices = Invoice::with('customer')->orderBy('id', 'desc')->get();
        return response()->json(['invoices' => $invoices], 200);
        // return response(['success' => true, 'message' => 'List Post Message!', 'invoices' => $invoices]);
    }
    public function searchInvoice(Request $request)
    {
        $search = $request->get('s');
        if ($search != null) {
            $invoices = Invoice::with('customer')->where('id', 'LIKE', "%$search%")->get();
            return response()->json(['invoices' => $invoices], 200);
        } else {
            return $this->index();
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function createInvoice()
    {
        $counter = Counter::where('key', 'Invoice')->first();
        $invoice = Invoice::orderBy('id', 'DESC')->first();
        if ($invoice) {
            $getInvoiceId = $invoice->id + 1;
            $getValueCounters = $counter->value + $getInvoiceId;
        } else {
            $getValueCounters = $counter->value;
        }

        $formData = [
            'number' => $counter->prefix . $getValueCounters, // INV-Value
            'customer_id' => null,
            'customer' => null,
            'date' => date('Y-m-d'),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'terms_and_conditions' => "Default Terms And Conditions",
            'items' => [
                [
                    'product_id' => null,
                    'product' => null,
                    'unit_price' => 0,
                    'quantity' => 1
                ]
            ]
        ];
        return response()->json($formData);
    }
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $invoiceItem = $request->input('invoice_item');
    //     invoice = $request->input('invoice_item');
    //     $invoiceItem = $request->input('invoice_item');
    // }
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'date' => 'required',
            'due_date' => 'required',
            'number' => 'required',
            'terms_and_conditions' => 'required',
            'subtotal' => 'required',
        ]);
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //create post
        $invoiceItem = $request->invoice_item;
        $invoiceData['sub_total'] = $request->subtotal;
        $invoiceData['total'] = $request->total;
        $invoiceData['customer_id'] = $request->customer_id;
        $invoiceData['number'] = $request->number;
        $invoiceData['date'] = $request->date;
        $invoiceData['due_date'] = $request->due_date;
        $invoiceData['discount'] = $request->discount;
        $invoiceData['reference'] = $request->reference;
        $invoiceData['terms_and_conditions'] = $request->terms_and_conditions;

        $invoice = Invoice::create($invoiceData);
        foreach (json_decode($invoiceItem) as $item) {
            $itemData['invoice_id'] = $invoice->id;
            $itemData['product_id'] = $item->product_id;
            $itemData['quantity'] = $item->quantity;
            $itemData['unit_price'] = $item->unit_price;

            InvoiceItem::create($itemData);
        }
        //return response
        // return response()->json($post, 200);
    }
    /**
     * Display the specified resource.
     */ 
    public function showInvoice($id)
    {
        // contoh jika multi Relasi, relasi antar invoice->invoiceitem->product
        // why invoiceitem.product? karna di table invoice_item product ada kolom productId. jadi untuk referencenya harus menuju table yang memiliki fk.
        $invoice = Invoice::with(['customer', 'invoice_item.product'])->find($id);
        return response()->json(['invoices' => $invoice], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'invoice_item.product'])->find($id);
        return response()->json(['invoices' => $invoice], 200);
    }
    public function updateInvoice(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'date' => 'required',
            'due_date' => 'required',
            'number' => 'required',
            'terms_and_conditions' => 'required',
            'subtotal' => 'required',
        ]);
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $invoice = Invoice::where('id', $id)->first();
        $invoice->sub_total = $request->subtotal;
        $invoice->total = $request->total;
        $invoice->customer_id = $request->customer_id;
        $invoice->number = $request->number;
        $invoice->date = $request->date;
        $invoice->due_date = $request->due_datel;
        $invoice->reference = $request->reference;
        $invoice->terms_and_conditions = $request->terms_and_conditions;

        $invoice->update($request->all());

        $invoiceItem = $request->invoice_item;
        $invoice->invoice_item()->delete();

        foreach (json_decode($invoiceItem) as $item) {
            $itemData['product_id'] = $item->product_id;
            $itemData['invoice_id'] = $invoice->id;
            $itemData['quantity'] = $item->quantity;
            $itemData['unit_price'] = $item->unit_price;

            InvoiceItem::create($itemData);
        }

        //return response
        // return response()->json($post, 200);
    }
    public function deleteInvoiceItem($id)
    {
        $invoiceItem = InvoiceItem::findOrfail($id);
        $invoiceItem->delete();
    }
    public function deleteInvoice($id)
    {
        $invoiceItem = Invoice::findOrfail($id);
        $invoiceItem->invoice_item()->delete();
        $invoiceItem->delete();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
