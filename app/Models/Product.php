<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  use HasFactory;

  protected $fillable = [
    'category_id',
    'product_name',
    'product_description',
    'qty',
    'price',
    'star',
    'time_value',
    'product_image',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function orders()
  {
    return $this->belongsToMany(Order::class);
  }

  protected function ProductImage(): Attribute
  {
    return Attribute::make(
      get: fn($image) => asset('/' . $image)
    );
  }
}
