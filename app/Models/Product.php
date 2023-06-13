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
}
