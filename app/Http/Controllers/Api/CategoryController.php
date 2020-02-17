<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(){
        return response()->json($this->category->all());
    }

    public function show(){}

    public function store(){}

    public function update(){}

    public function destroy(){}
}
