<?php

namespace Admin\Products\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray( $request )
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'status' => $this->status,
        ];
    }
}