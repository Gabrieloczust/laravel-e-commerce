<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Sale;

class DashboardController extends Controller
{
    public function index(Request $request)
    {        
        $months = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        // Mês recebido por get
        $filter = ($request->input('month', date('m')));

        // Produtos cadastrados no mes
        $filterProducts = Product::whereMonth('created_at', $filter)->count();

        // Cartegorias cadastrados no mes
        $filterCategories = Category::whereMonth('created_at', $filter)->count();

        // Vendas feitas no mes
        $filterSales = Sale::whereMonth('created_at', $filter)->count();

        // Faturamento no mes
        $filterSalesTotal = Sale::whereMonth('created_at', $filter)->sum('total');
        
        // Venda feita por dia do mes
        $sales = Sale::whereMonth('created_at', $filter)->get();   
        $days = [];
        foreach ($sales as $sale) :
            $dia = date("d", strtotime($sale->created_at));
            $days[$dia]['total'] = $sale->total;
        endforeach;
        ksort($days);

        // Faturamento em % relaciondo ao mes passado
        $lastMonth = date('m', $filter);
        $lastSales = Sale::whereMonth('created_at', $lastMonth)->sum('total');
        $filterIncrease = (($filterSalesTotal - $lastSales) / $lastSales) * 100;        

        return view('admin.dashboard.index', [
            'months' => $months,
            'days' => $days,
            'filter' => $filter,
            'filterProducts' => $filterProducts,
            'filterCategories' => $filterCategories,
            'filterSales' => $filterSales,
            'filterSalesTotal' => $filterSalesTotal,
            'filterIncrease' => $filterIncrease,
        ]);
    }
}
