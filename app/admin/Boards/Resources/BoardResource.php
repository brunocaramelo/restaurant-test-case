<?php

namespace Admin\Boards\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
{
    public function toArray( $request )
    {
        return [
            'number' => $this->number,
            'status' => $this->status,
        ];
    }
}