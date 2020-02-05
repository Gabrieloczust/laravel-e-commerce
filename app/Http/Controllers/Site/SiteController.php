<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function index(Request $request)
    {

        // Categorias
        $categories = DB::table('categories')
            ->rightJoin('products', 'categories.id', '=', 'products.category_id')
            ->selectRaw('categories.*')
            ->groupBy('categories.name')
            ->get();
        $categories = $categories->keyBy('id');

        // Filtro de categoria
        $filterCategory = $request->input('category');
        $existCategory = $categories->get($filterCategory);

        if ($existCategory) {
            $products = Product::where('category_id', $filterCategory)->orderBy('name')->get();
        } else {
            $products = Product::orderBy('name')->get();
        }

        // Pesquisa por busca
        $warning = null;
        $search = $request->input('search');
        if ($search) {
            $productsSearch = Product::where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
            if (count($productsSearch) > 0) {
                $products = $productsSearch;
            } else {
                $products = [];
                $warning = "Nenhum resultado encontrado para <b>$search</b>, tente novamente!";
            }
        }

        // Quantidade de produtos
        $countProducts = count($products);

        // Carrinho
        $cart = Session::get('cart', []);
        $cartTotal = Cart::cartTotal($cart);
        $cartCount = Cart::cartCount($cart);

        return view('site.products', [
            'categories' => $categories,
            'products' => $products,
            'filterCategory' => $filterCategory,
            'existCategory' => $existCategory,
            'countProducts' => $countProducts,
            'warning' => $warning,
            'search' => $search,
            'cart' => $cart,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
        ]);
    }
}
