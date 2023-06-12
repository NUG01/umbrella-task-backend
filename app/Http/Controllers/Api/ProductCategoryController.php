<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    public function index()
    {
        return response()->json(['categories' => ProductCategory::orderBy('name')->get()]);
    }
    public function store(StoreProductCategoryRequest $request)
    {

        $category = ProductCategory::create(['name' => $request->category_name]);

        return response()->json(['category' => $category]);
    }
}
