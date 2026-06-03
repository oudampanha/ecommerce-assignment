<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'description' => $this->description,
      'category_image' => $this->category_image,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'products_count' => $this->products_count, // If using withCount()
      'products' => ProductResource::collection($this->whenLoaded('products')), // If products are loaded
    ];
  }
}