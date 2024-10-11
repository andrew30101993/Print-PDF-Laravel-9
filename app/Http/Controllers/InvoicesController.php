<?php

namespace App\Http\Controllers;

use App\Models\InvoiceProducts;
use App\Models\Invoices;
use App\Models\Products;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use PDF;
use Redirect;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = User::where("role","customer")->get();
        $products = Products::get();
        
        $query = Invoices::leftJoin("users","users.id", "invoices.customer_id")
                ->select("invoices.*","users.name as customer_name");

        if ($request->customer_id != "" && !empty($request->customer_id)) {
            $customer_id = $request->customer_id;
            $query->where(function($query) use($customer_id){
                $query->where('invoices.customer_id',$customer_id);
            });
        }

        $invoices = $query->paginate(25);
        return view('invoices.index', ['invoices' => $invoices,'customers' => $customers,'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $digits = 4;
        $number = rand(pow(10, $digits-1), pow(10, $digits)-1);

        $customers = User::where("role","customer")->get();
        
        $products = Products::where("quantity",">=",1)->get();
        return view('invoices.create', compact('number', 'customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'invoice_number' => 'required',
            'salesman_name' => 'required',
            'invoice_date' => 'required|date',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.gst' => 'required|numeric|min:0',
        ]);

        // Save the main invoice data
        $invoice = new Invoices();
        $invoice->customer_id = $request->customer_id;
        $invoice->invoice_number = $request->invoice_number;
        $invoice->salesman_name = $request->salesman_name;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->sub_total = $request->invoice_subtotal;
        $invoice->gst_total = $request->invoice_gst_total;
        $invoice->grand_total = $request->invoice_grand_total;
        $invoice->description = $request->description;
        $invoice->save();
    
        // Save the products for the invoice in invoice_tables
        foreach ($request->products as $productData) {
            $InvoiceProduct = new InvoiceProducts();
            $InvoiceProduct->invoice_id = $invoice->id;
            $InvoiceProduct->product_id = $productData['id'];
            $InvoiceProduct->pur_quantity = $productData['quantity'];
            $InvoiceProduct->price = $productData['price'];
            $InvoiceProduct->sub_total = $productData['subtotal'];
            $InvoiceProduct->gst = $productData['gst'];
            $InvoiceProduct->total = $productData['total'];
            $InvoiceProduct->save();

            // Update the product's quantity in the products table
            $product = Products::find($productData['id']);
            if ($product) {
                $product->quantity -= $productData['quantity'];  // Deduct the purchased quantity
                $product->save();
            }
        }

        return redirect()->route(route: 'invoices.index')->with('success','Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {                       
        $invoice = Invoices::with(['customer', 'invoiceProducts.product'])
                   ->where('id', $id)
                   ->first();
        
        // Load the view and pass the invoice data to it
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));

        // Download the PDF with the invoice number as the filename
        return $pdf->download('invoice_' . $invoice->number . '.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoices::find($id);
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully');
    }
}
