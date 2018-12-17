<?php

namespace Admin\Bills\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Admin\Products\Resources\ProductResource;
use Admin\Bills\Resources\BillItemResource;
use Admin\Boards\Resources\BoardResource;

class BillResource extends JsonResource
{
    public function toArray( $request )
    {
        return [
            'id' => $this->id,
            'balance' => $this->balance,
            'partial_balance' => $this->partial_balance,
            'products' => BillItemResource::collection( $this->itens )->toArray( [] ),
            'board' => ( new BoardResource( $this->board ) )->toArray( [] ),
        ];
    }
}