<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'product_name' => $this->product_name,
      'product_description' => $this->product_description,
      'qty' => $this->qty,
      'price' => $this->price,
      'star' => $this->star,
      'time_value' => $this->time_value,
      'product_image' => $this->product_image,
      'category_id' => $this->category_id,
      'category' => $this->whenLoaded('category', function () {
        return new CategoryResource($this->category);
      }),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at
    ];
  }
}