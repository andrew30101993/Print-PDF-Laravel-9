<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::paginate(25);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $digits = 4;
        $number = rand(pow(10, $digits-1), pow(10, $digits)-1);
        return view('products.create', compact('number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name" => 'required',
            "number" => 'required',
            "quantity" => 'required',
            "purchase_price" => 'required',
            "selling_price" => 'required',
            'product_image' => 'required|image|mimetypes:image/jpeg,image/png,image/svg+xml,image/webp|max:1000',
            "sgst" => 'required',
            "cgst" => 'required',
            "igst" => 'required',            
        ],[
            'image.mimetypes' => 'Image must by type of jpg, jpeg, png, svg, webp'
        ]);

        $imageName = time() . '.' . $request->product_image->extension();
        $request->product_image->move(public_path(path: 'products'), $imageName);

        $product = new Products();
        $product->name = $request->name;
        $product->number = $request->number;
        $product->quantity = $request->quantity;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->image = $imageName;
        $product->sgst = $request->sgst;
        $product->cgst = $request->cgst;
        $product->igst = $request->igst;

        // if successfully save data
        if($product->save()){
            return redirect()->route('productlist.index')->with('success','Product created successfully.');
        }
        else{
            return back()->with('failure','Product does not added!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Products::find($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            "name" => 'required',
            "number" => 'required',
            "quantity" => 'required',
            "purchase_price" => 'required',
            "selling_price" => 'required',
            "sgst" => 'required',
            "cgst" => 'required',
            "igst" => 'required',            
        ]);


        $product = Products::find($id);

        if($product){

            $product->name = $request->name;
            $product->number = $request->number;
            $product->quantity = $request->quantity;
            $product->purchase_price = $request->purchase_price;
            $product->selling_price = $request->selling_price;
            $product->sgst = $request->sgst;
            $product->cgst = $request->cgst;
            $product->igst = $request->igst;

            if ($request->hasFile('product_image')) {
                $imageName = time() . '.' . $request->product_image->extension();
    
                $request->product_image->move(public_path('products'), $imageName);
    
                $product->image = $imageName;
            }

            // if successfully update the data
            if($product->save()){
                return redirect()->route('productlist.index')->with('success','Product updated successfully.');
            }
            else{
                return back()->with('failure','Product does not updated!');
            }
        }
        else{
            return redirect()->route(route: 'productlist.index')->with('failure','Invalid data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::find($id);
        $product->delete();
        return redirect()->route('productlist.index')->with('success', 'product deleted successfully');
    }


    /**
     * Get Product details
     */
    public function show($id)
    {
        $product = Products::findOrFail($id);
        return response()->json([
            'quantity' => $product->quantity,
            'price' => $product->selling_price,
            'gst' => $product->sgst + $product->cgst,
        ]);
    }
}
