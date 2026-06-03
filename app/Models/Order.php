<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'restaurant_id',
    'driver_id',
    'order_date',
    'status',
    'delivery_address',
    'latitude',
    'longitude',
    'delivery_fee',
    'total_amount',
    'payment_method',
    'payment_status',
    'notes',
  ];

  public function restaurant()
  {
    return $this->belongsTo(Restaurant::class);
  }

  public function driver()
  {
    return $this->belongsTo(User::class, 'driver_id');
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function orderDetails()
  {
    return $this->hasMany(OrderDetails::class);
  }
}
