<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Month;
use App\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        // Ano atual
        $year = date('Y');

        // Vendas feitas por cada mes do ano
        $salesMonth = Sale::selectRaw('month(created_at) month, sum(total) total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->toArray();

        $salesYear = array_reduce($salesMonth, function ($total, $saleMonth) {
            $total += $saleMonth['total'];
            return $total;
        });

        return view('admin.sales.index', [
            'salesMonth' => $salesMonth,
            'salesYear' => $salesYear,
            'year' => $year,
        ]);
    }
}
