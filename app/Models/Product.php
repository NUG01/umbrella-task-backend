<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;


    protected $guarded = [
        'id'
    ];


    protected $casts = [
        'product_categories_id' => 'array',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }


    public function scopeFilter($q)
    {
        $q->when(!empty(request()->product_name), function ($query) {
            $query->where('name', 'like', request()->product_name . '%');
        })->when(!empty(request()->category_name), function ($query) {
            $categoryId = ProductCategory::where('name', request()->category_name)->first()['id'];
            $query->whereJsonContains('product_categories_id', $categoryId);
        })->when(!empty(request()->price), function ($query) {
            $query->where('price', '<=', request()->price);
        })->when(!empty(request()->description), function ($query) {
            $query->where('description', 'like', request()->description . '%');
        });
    }
}
