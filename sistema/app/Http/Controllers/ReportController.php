<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Models\DetailSale;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from', now()->subMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());

        $sales = Sale::with(['customer', 'user'])
            ->whereDate('date', '>=', $from)
            ->whereDate('date', '<=', $to)
            ->latest('date')
            ->get();

        $units = DetailSale::whereHas('sale', fn ($query) => $query
            ->whereDate('date', '>=', $from)
            ->whereDate('date', '<=', $to))
            ->sum('amount');

        return view('reports.index', [
            'from' => $from,
            'to' => $to,
            'sales' => $sales,
            'count' => $sales->count(),
            'total' => $sales->sum('total'),
            'units' => $units,
        ]);
    }

    public function pdf(Request $request)
    {
        $from = $request->input('from', now()->subMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());

        $sales = Sale::with(['customer', 'user'])
            ->whereDate('date', '>=', $from)
            ->whereDate('date', '<=', $to)
            ->latest('date')
            ->get();

        $pdf = Pdf::loadView('reports.pdf', compact('sales', 'from', 'to'));

        return $pdf->download('ventas-'.$from.'-'.$to.'.pdf');
    }

    public function excel(Request $request)
    {
        $from = $request->input('from', now()->subMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());

        return Excel::download(new SalesExport($from, $to), 'ventas-'.$from.'-'.$to.'.xlsx');
    }
}
