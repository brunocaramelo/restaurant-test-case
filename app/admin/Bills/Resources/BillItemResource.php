<?php
namespace Admin\Bills\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Admin\Products\Resources\ProductResource;
use Admin\Boards\Resources\BoardResource;

class BillItemResource extends JsonResource
{
    public function toArray( $request )
    {
        return (new ProductResource( $this->product ))->toArray([]);
    }
}