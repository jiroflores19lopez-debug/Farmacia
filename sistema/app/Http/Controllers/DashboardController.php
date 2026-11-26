<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Medicine;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $salesByDay = Sale::selectRaw('DATE(date) as day, SUM(total) as total')
            ->where('date', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return view('principal.dashboard.index', [
            'salesCount' => Sale::count(),
            'salesTotal' => Sale::sum('total'),
            'customersCount' => Customer::count(),
            'lowStockCount' => Medicine::where('stock', '<=', 10)->count(),
            'salesByDay' => $salesByDay,
            'topMedicines' => DB::table('detail_sales')
                ->join('medicines', 'medicines.id', '=', 'detail_sales.medicine_id')
                ->select('medicines.name', DB::raw('SUM(detail_sales.amount) as amount'))
                ->groupBy('medicines.name')
                ->orderByDesc('amount')
                ->limit(5)
                ->get(),
        ]);
    }
}
