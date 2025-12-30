<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'description',
        'reviews',
        'image',
    ];

    public function cartItems(): HasMany {
        return $this->hasMany(CartItem::class);
    }

    public function orderDetails(): HasMany {
        return $this->hasMany(OrderDetail::class);
    }

    protected function scopeCategory(Builder $query, string $category) : void {
        $query->where('category', $category);
    }

    protected function scopeSearch(Builder $query, string $name) : void {
        $query->where('name', 'like', '%' . $name . '%');
    }

    protected function scopeFilter(Builder $query, array $req) {
        if ($req['dog'] && $req['cat'])
            $query->where('for', 'dog')->orWhere('for', 'cat');
        elseif ($req['dog'])
            $query->where('for', 'dog');
        elseif ($req['cat'])
            $query->where('for', 'cat');

        if ($req['price']) {
            if ($req['price'] === 'asc') $query->orderBy('price', 'asc');
            else $query->orderBy('price', 'desc');
        } else {
            if ($req['rating'] === 'asc') $query->orderBy('reviews', 'asc');
            else $query->orderBy('reviews', 'desc');
        }
    }
}
