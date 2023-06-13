<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(['products' => ProductCategory::orderBy('name')->get()]);
    }
    public function store(StoreProductCategoryRequest $request)
    {

        $category = ProductCategory::create(['name' => $request->category_name]);

        return response()->json(['category' => $category]);
    }
}
