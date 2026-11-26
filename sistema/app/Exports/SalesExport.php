<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    public function __construct(private readonly string $from, private readonly string $to) {}

    public function collection(): Collection
    {
        return Sale::with(['customer', 'user'])
            ->whereDate('date', '>=', $this->from)
            ->whereDate('date', '<=', $this->to)
            ->latest('date')
            ->get()
            ->map(fn (Sale $sale) => [
                'id' => $sale->id,
                'fecha' => $sale->date,
                'cliente' => $sale->customer?->name,
                'usuario' => $sale->user?->name,
                'igv' => $sale->igv,
                'total' => $sale->total,
            ]);
    }

    public function headings(): array
    {
        return ['N.', 'Fecha', 'Cliente', 'Usuario', 'IGV', 'Total'];
    }
}
