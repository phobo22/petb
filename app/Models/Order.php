<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'shipping_info_id',
        'payment_method',
        'order_at',
        'total',
        'status',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function details() : HasMany {
        return $this->hasMany(OrderDetail::class);
    }

    public function shippingInfo() : BelongsTo {
        return $this->belongsTo(ShippingAddress::class);
    }
}
