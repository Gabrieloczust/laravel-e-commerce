<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::all()
        ]);
    }

    public function create(Request $request)
    {
        $categoryActive = $request->input('category');
        if ($categoryActive) {
            $categories[0] = Category::find($categoryActive);
        } else {
            $categories = Category::all();
        }

        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    public function store(ProductRequest $request)
    {
        if (Category::find($request->category_id)) {
            $validated = $request->validated();
            if ($request->file('photo')) {
                $validated['photo'] = $request->file('photo')->store('products');
            }
            Product::create($validated);
        }

        return redirect()->route('products.index')->with('warning', "Produto <b>$request->name</b> cadastrado!");
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        if (Category::find($request->category_id)) {
            $validated = $request->validated();
            if ($request->file('photo')) {
                $validated['photo'] = $request->file('photo')->store('products');
            }
            $product->update($validated);
        }
        return redirect()->route('products.index')->with('warning', "Produto <b>$request->name</b> atualizado!");
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('warning', "Produto <b>$product->name</b> deletado!");
    }
}
