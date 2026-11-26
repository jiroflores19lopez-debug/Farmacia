<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de ventas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #212529; }
        h1 { font-size: 18px; margin-bottom: 4px; }
        .period { color: #6c757d; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dee2e6; padding: 7px; text-align: left; }
        th { background: #f8f9fa; }
        .text-end { text-align: right; }
    </style>
</head>
<body>
    <h1>FARM SJB - Reporte de ventas</h1>
    <div class="period">Periodo: {{ $from }} al {{ $to }}</div>
    <table>
        <thead>
            <tr>
                <th>N.</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th class="text-end">IGV</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($sales as $sale)
            <tr>
                <td>#{{ $sale->id }}</td>
                <td>{{ $sale->date }}</td>
                <td>{{ $sale->customer?->name }}</td>
                <td>{{ $sale->user?->name }}</td>
                <td class="text-end">S/ {{ number_format((float) $sale->igv, 2) }}</td>
                <td class="text-end">S/ {{ number_format((float) $sale->total, 2) }}</td>
            </tr>
        @empty
            <tr><td colspan="6">No hay ventas en el periodo seleccionado.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
