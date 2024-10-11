<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where("role","customer")->paginate(25);
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'address' => 'required',
        ]);

        $customer = new User();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make('123456');
        $customer->address = $request->address;
        $customer->role = "customer";

        if ($customer->save()) {
            return redirect()->route('customers.index')->with('success', 'Customer Added successfully.');
        } else {
            return redirect()->route('customers.index')->with('failure', 'Customer Not Added successfully.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = User::find($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $customer = User::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;

        if ($customer->save()) {
            return redirect()->route('customers.index')->with('success', 'Customer Added successfully.');
        } else {
            return redirect()->route('customers.index')->with('failure', 'Customer Not Added successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = User::find($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
