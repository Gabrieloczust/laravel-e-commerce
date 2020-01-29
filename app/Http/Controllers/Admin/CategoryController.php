<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        if ($request->file('photo')) {
            $validated['photo'] = $request->file('photo')->store('category');
        }
        Category::create($validated);

        return redirect()->route('categories.index')->with('warning', "Categoria <b>$request->name</b> cadastrada com sucesso!");
    }

    public function show(Category $category)
    {
        $products = $category->product()->get();

        return view('admin.categories.show', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        if ($request->file('photo')) {
            Storage::delete($category->photo);
            $validated['photo'] = $request->file('photo')->store('category');
        }
        $category->update($validated);

        return redirect()->route('categories.index')->with('warning', "Categoria <b>$category->name</b> atualizada!");
    }

    public function destroy(Category $category)
    {
        $name = $category->name;
        Storage::delete($category->photo);
        $category->delete();
        return redirect()->back()->with('warning', "Categoria <b>$name</b> deletada com sucesso!");
    }
}
