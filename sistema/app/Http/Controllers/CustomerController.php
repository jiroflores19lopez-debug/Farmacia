<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.customers.index', ['customers' => Customer::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'dni' => ['required', 'digits:8', 'unique:customers,dni'],
            'phone' => ['nullable', 'max:20'],
            'age' => ['nullable', 'integer', 'min:0', 'max:120'],
        ]);

        Customer::create([
            'name' => $validated['nombre'],
            'dni' => $validated['dni'],
            'phone' => $validated['phone'] ?? null,
            'age' => $validated['age'] ?? null,
        ]);

        return to_route('customers.index')->with('ok', 'Cliente registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('management.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'dni' => ['required', 'digits:8', Rule::unique('customers', 'dni')->ignore($customer->id)],
            'phone' => ['nullable', 'max:20'],
            'age' => ['nullable', 'integer', 'min:0', 'max:120'],
        ]);

        $customer->update([
            'name' => $validated['nombre'],
            'dni' => $validated['dni'],
            'phone' => $validated['phone'] ?? null,
            'age' => $validated['age'] ?? null,
        ]);

        return to_route('customers.index')->with('ok', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return to_route('customers.index')->with('ok', 'Cliente eliminado correctamente.');
    }
}
