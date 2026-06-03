<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cuisine_type',
        'address',
        'image',
        'phone',
        'rating',
        'is_active',
    ];

    /**
     * Relationship with Menu Items (Products)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relationship with Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
