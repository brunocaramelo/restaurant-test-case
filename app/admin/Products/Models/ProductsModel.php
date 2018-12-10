<?php

namespace Admin\Products\Models;

use Admin\Products\Repositories\ProductsRepository;
use Admin\Products\Entities\ProductEntity;

class ProductsModel
{
    private $product = null;
    
    public function __construct()
    {
        $this->product = new ProductsRepository( new ProductEntity() );
    }

    public function getList()
    {
        return $this->product->getList()->get();
    }

    public function edit( $identify )
    {
        $edit = $this->find( $identify );
        unset( $edit['created_at'], $edit['updated_at'] , $edit['api_token'] );
        return $edit;
    }

    public function find( $identify )
    {
        return $this->product->find( $identify );
    }

    public function findByNumber( $value )
    {
        return $this->findBy( 'number' , $value );
    }
}