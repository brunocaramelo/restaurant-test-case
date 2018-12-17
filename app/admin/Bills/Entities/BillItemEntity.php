<?php

namespace Admin\Bills\Entities;

use Illuminate\Database\Eloquent\Model;

class BillItemEntity extends Model
{
    protected $table = 'bill_itens';
    
    protected $fillable = [
                            'product_id', 
                            'bill_id',
                        ];
    
    public function product()
    {
        return $this->hasOne( \Admin\Products\Entities\ProductEntity::class , 'id' , 'product_id' );
    }    
}
