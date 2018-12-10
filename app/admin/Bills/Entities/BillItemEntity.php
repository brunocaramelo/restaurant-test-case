<?php

namespace Admin\Bills\Entities;

use Illuminate\Database\Eloquent\Model;

class BillItemEntity extends Model
{
    protected $table = 'bills_item';
    
    protected $fillable = [
                            'product_id', 
                            'bill_id',
                        ];
    

}
