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

        $filter = ($request->input('month', date('m')));

        $filterProducts = Product::whereMonth('created_at', $filter)->count();
        $filterCategories = Category::whereMonth('created_at', $filter)->count();
        $filterSales = Sale::whereMonth('created_at', $filter)->sum('total');
        
        $sales = Sale::whereMonth('created_at', $filter)->get();
        
        //$days = cal_days_in_month(CAL_GREGORIAN, $filter, date('Y'));
        $days = [];
        foreach ($sales as $sale) :
            $dia = date("d", strtotime($sale->created_at));
            $days[$dia]['dia'] = 'Dia ' . $dia;
            $days[$dia]['total'] = $sale->total;
        endforeach;
        

        return view('admin.dashboard.index', [
            'months' => $months,
            'days' => $days,
            'filter' => $filter,
            'filterProducts' => $filterProducts,
            'filterCategories' => $filterCategories,
            'filterSales' => $filterSales,
            'sales' => $sales,
        ]);
    }
}
