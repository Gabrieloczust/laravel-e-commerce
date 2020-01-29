<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $months = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        $filter = ($request->input('month', date('m')));

        $filterProducts = DB::table('products')
        ->selectRaw('count(*) as monthCount, MONTH(created_at) AS month')
        ->groupBy('month')
        ->having('month', $filter)
        ->first();

        $filterCategories = DB::table('categories')
        ->selectRaw('count(*) as monthCount, MONTH(created_at) AS month')
        ->groupBy('month')
        ->having('month', $filter)
        ->first();
        
        return view('admin.dashboard.index', [
            'months' => $months,
            'filter' => $filter,
            'filterProducts' => $filterProducts,
            'filterCategories' => $filterCategories,
            'sales' => 'R$ 0,00'
        ]);
    }
}
