<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        if (!request()->has('product_name')) {

            return response()->json(ProductResource::collection(Product::latest()->get()));
        }


        $products = Product::query()
            ->when(!empty(request()->product_name), function ($query) {
                $query->where('name', 'like', request()->product_name . '%');
            })
            ->when(!empty(request()->category_name), function ($query) {
                $categoryId = ProductCategory::where('name', request()->category_name)->first()['id'];
                $query->whereJsonContains('product_categories_id', $categoryId);
            })->when(!empty(request()->price), function ($query) {
                $query->where('price', '<=', request()->price);
            })->when(!empty(request()->description), function ($query) {
                $query->where('description',  'like',  request()->description . '%');
            })->get();

        return response()->json(ProductResource::collection($products));
    }
    public function destroy($productId)
    {
        Product::where('id', $productId)->delete();
        return response()->noContent();
    }
    public function store(StoreProductRequest $request)
    {
        $categoryArray = [];
        for ($i = 0; $i < count($request->product_categories_id); $i++) {
            array_push($categoryArray, intval($request->product_categories_id[$i]));
        }

        $product = Product::create([
            'product_categories_id' => $categoryArray,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if (request()->has('images')) {
            for ($i = 0; $i < count(request()->file('images')); $i++) {
                $currentImage = request()->file('images')[$i]->store('thumbnails');
                Image::create([
                    'path' =>  $currentImage,
                    'product_id' => $product['id']
                ]);
            }
        }

        return response()->json(['product' => $product, 'images' => $product->images]);
    }
}
