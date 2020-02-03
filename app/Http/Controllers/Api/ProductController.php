<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessage;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {

        return response()->json($this->product->paginate(10));
    }

    public function show($id)
    {
        $product = $this->product->find($id);

        if (!$product) return response()->json(ApiMessage::errorMessage("Produto nao encontrado!", 4040), 404);

        return response()->json(['data' => $product]);
    }

    public function store(Request $request)
    {
        try {

            $this->product->create($request->all());

            return response()->json(ApiMessage::successMessage("Produto $request->name criado com sucesso!", 201));
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiMessage::errorMessage($e->getMessage(), 1010), 500);
            } else {
                return response()->json(ApiMessage::errorMessage('Houve um erro ao realizar operacao de criar!'), 500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $product = $this->product->find($id);
            $product->update($request->all());

            return response()->json(ApiMessage::successMessage("Produto $request->name atualizado com sucesso!", 201));
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiMessage::errorMessage($e->getMessage(), 1011), 500);
            } else {
                return response()->json(ApiMessage::errorMessage('Houve um erro ao realizar operacao de atualizar!', 1011), 500);
            }
        }
    }

    public function destroy(Product $id)
    {
        try {

            $id->delete();

            return response()->json(ApiMessage::successMessage("Produto $id->name removido com sucesso!", 200));
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiMessage::errorMessage($e->getMessage(), 1012), 500);
            } else {
                return response()->json(ApiMessage::errorMessage('Houve um erro ao realizar operacao de deletar!', 1012), 500);
            }
        }
    }
}
