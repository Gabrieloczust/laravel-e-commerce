<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $warning = null;

        $categories = DB::table('categories')
            ->rightJoin('products', 'categories.id', '=', 'products.category_id')
            ->selectRaw('categories.*')
            ->groupBy('categories.name')
            ->get();
        $categories = $categories->keyBy('id');

        $filterCategory = $request->input('category');
        $existCategory = $categories->get($filterCategory);

        if ($existCategory) {
            $products = Product::where('category_id', $filterCategory)->orderBy('name')->get();
        } else {
            $products = Product::orderBy('name')->get();
        }

        
        $search = $request->input('search');
        if ($search) {
            $productsSearch = Product::where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
            if(count($productsSearch) > 0){
                $products = $productsSearch;
            } else{
                $products = [];
                $warning = "Nenhum resultado encontrado para <b>$search</b>, tente novamente!";
            }
        }
        
        $countProducts = count($products);

        return view('site.home', [
            'categories' => $categories,
            'products' => $products,
            'filterCategory' => $filterCategory,
            'existCategory' => $existCategory,
            'countProducts' => $countProducts,
            'warning' => $warning,
            'search' => $search,
        ]);
    }
}
