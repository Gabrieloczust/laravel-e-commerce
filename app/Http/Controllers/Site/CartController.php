<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Cart;
use App\Product;
use App\Sale;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        if (!Session::exists('cart')) {
            Session::put('cart', []);
        }
    }

    public function store(Product $product)
    {
        $cart = Session::get('cart');

        if ($product->stock > 0) {
            if (isset($cart[$product->id])) {
                $this->plus($product);
            } else {
                $item = new Cart();
                $item->product_id = $product->id;
                $item->product_name = $product->name;
                $item->product_price = $product->price;
                $item->product_stock = $product->stock;
                $item->product_amount++;
                $this->multiply($item);
                $cart[$product->id] = $item;

                Session::put('cart', $cart);
                Session::flash('success', "Produto <b>$product->name</b> adicionado no carrinho!");
            }
        } else{
            Session::flash('danger', "Produto <b>$product->name</b> não possui estoque!");
        }

        return redirect()->back();
    }

    public function clear()
    {
        Session::forget('cart');
        Session::flash('danger', "Carrinho limpo!");
        return redirect()->back();
    }

    public function plus(Product $product)
    {
        $cart = Session::get('cart');
        if ($cart[$product->id]->product_amount < $product->stock) {
            $cart[$product->id]->product_amount++;
            $this->multiply($cart[$product->id]);
        } else {
            Session::flash('danger', "Produto <b>$product->name</b> não possui mais estoque!");
        }
        return redirect()->back();
    }

    public function less(Product $product)
    {
        $cart = Session::get('cart');
        if ($cart[$product->id]->product_amount > 1) {
            $cart[$product->id]->product_amount--;
            $this->multiply($cart[$product->id]);
        } else {
            unset($cart[$product->id]);
            Session::flash('success', "Produto <b>$product->name</b> removido do carrinho!");
            Session::put('cart', $cart);
        }
        return redirect()->back();
    }

    public function save()
    {
        $cart = Session::get('cart');

        // Salva a venda no banco
        $data['total'] = Cart::cartTotal($cart);
        $idSale = Sale::create($data)->id;

        foreach ($cart as $product) {
            // Atualiza o estoque de cada produto do carrinho
            $productAtt = Product::find($product->product_id);
            $productAtt->stock -=  $product->product_amount;
            $productAtt->save();

            // Salva no banco cada produto do carrinho
            $p = $product->toArray();
            $p['sale_id'] = $idSale;
            Cart::create($p);
        }

        Session::forget('cart');
        Session::flash('success', "Compra Finalizada!");
        return redirect()->back();
    }

    protected function multiply($item)
    {
        return $item->product_total = $item->product_amount * $item->product_price;
    }
}
