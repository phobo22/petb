<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'reviews',
        'image',
    ];

    protected function scopeCategory(Builder $query, string $category) : void {
        $query->where('category', $category);
    }
}
