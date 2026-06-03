<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
  use HasFactory;

  protected $fillable = [
    'slider_image',
    'slider_description'
  ];

  protected function SliderImage(): Attribute
  {
    return Attribute::make(
      get: fn($image) => asset('/' . $image)
    );
  }
}
