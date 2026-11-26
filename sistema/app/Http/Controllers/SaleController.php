<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetailSale;
use App\Models\Medicine;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.sales.index', [
            'sales' => Sale::with(['customer', 'user', 'details.medicine'])->latest('date')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.sales.create', [
            'customers' => Customer::orderBy('name')->get(),
            'medicines' => Medicine::where('stock', '>', 0)->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'medicine_id' => ['required', 'exists:medicines,id'],
            'amount' => ['required', 'integer', 'min:1'],
        ]);

        $medicine = Medicine::findOrFail($validated['medicine_id']);

        if ($medicine->stock < $validated['amount']) {
            return back()->withInput()->with('error', 'No hay stock suficiente para la cantidad solicitada.');
        }

        DB::transaction(function () use ($validated, $medicine) {
            $subtotal = round($medicine->price * $validated['amount'], 2);
            $igv = round($subtotal * 0.18, 2);

            $sale = Sale::create([
                'customer_id' => $validated['customer_id'],
                'user_id' => auth()->id(),
                'date' => now(),
                'total' => round($subtotal + $igv, 2),
                'igv' => $igv,
            ]);

            DetailSale::create([
                'sale_id' => $sale->id,
                'medicine_id' => $medicine->id,
                'amount' => $validated['amount'],
                'price_unit' => $medicine->price,
                'subtotal' => $subtotal,
            ]);

            $medicine->decrement('stock', $validated['amount']);
        });

        return to_route('sales.index')->with('ok', 'Venta registrada correctamente.');
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
    public function edit(string $id)
    {
        //
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
