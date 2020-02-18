<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessage;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $get = $request->paginate ? $this->category->paginate($request->paginate) : $this->category->all();
        return response()->json($get);
    }

    public function show($id)
    {
        $category = $this->category->find($id);

        if (!$category) return response()->json(ApiMessage::errorMessage("Categoria não encontrada!", 404), 404);

        return response()->json(['data' => $category]);
    }

    public function store(Request $request)
    {
        try {
            $this->category->create($request->all());

            return response()->json(ApiMessage::successMessage("Categoria $request->name criada com sucesso!", 201));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                return response()->json(ApiMessage::errorMessage($th->getMessage(), 1010), 500);
            } else {
                return response()->json(ApiMessage::errorMessage('Houve um erro ao realizar operacao de criar!', 1010), 500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $category = $this->category->find($id);
            $category->update($request->all());

            return response()->json(ApiMessage::successMessage("Categoria $id atualizada com sucesso!", 201));
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                return response()->json(ApiMessage::errorMessage($th->getMessage(), 1011), 500);
            } else {
                return response()->json(ApiMessage::errorMessage('Houve um erro ao realizar operacao de atualizar!', 1011), 500);
            }
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->category->find($id);
            if (!$category) return response()->json(ApiMessage::errorMessage('Esta categoria não existe!', 404), 404);
            $products = $category->product()->get(['id', 'name']);

            $data = ApiMessage::successMessage("Categoria $category->name removida com sucesso e seus produtos!", 200);
            $data['products'] = $products;
            $data['this'] = $category;

            $category->delete();

            return response()->json($data);
        } catch (\Throwable $th) {
            if (config('app.debug')) {
                return response()->json(ApiMessage::errorMessage($th->getMessage(), 1012), 500);
            } else {
                return response()->json(ApiMessage::errorMessage('Houve um erro ao realizar operacao de deletar!', 1012), 500);
            }
        }
    }
}
