<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'status',
        'created_at',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function product() : BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
