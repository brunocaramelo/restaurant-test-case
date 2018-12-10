<?php

namespace Admin\Products\Entities;
use \Illuminate\Database\Eloquent\Model;

class ProductEntity extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
                            'name', 
                            'price', 
                            'status',
                        ];

}
