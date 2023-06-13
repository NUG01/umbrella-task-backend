<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category_names' => ProductCategory::whereIn('id', $this->product_categories_id)->pluck('name'),
            'images' => $this->images,
            'price' => $this->price,
            'created_at' => $this->created_at,
        ];
    }
}
