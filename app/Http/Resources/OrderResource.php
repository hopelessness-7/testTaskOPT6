<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'address' => $this->address,
            'price' => $this->price,
            'date_order' => $this->date_order,
            'products' => ProductResource::collection($this->products)
        ];
    }
}
