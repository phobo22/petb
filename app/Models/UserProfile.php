<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'gender',
        'dob',
        'phone',
        'address',
    ];

    public function user(): BelongsTo { 
        return $this->belongsTo(User::class);
    }
}
