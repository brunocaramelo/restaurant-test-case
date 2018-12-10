<?php 

namespace Admin\Products\Repositories;

use Admin\Products\Entities\ProductEntity;

class ProductsRepository
{
    private $product = null;

    public function __construct( ProductEntity $product )
    {
        $this->product = $product;
    }

    public function getList()
    {
        $query = $this->product->select(
                                'us.id as id',
                                'us.name as name',
                                'us.price as price'
                                )
                            ->from('products AS us')
                            ->where( 'us.status' , '=' , 'active' );
        return $query;
    }

    public function find( $identify )
    {
        return $this->product->find( $identify );
    }

    public function findBy( $field , $value )
    {
        return $this->product->where( $field , $value );
    }

}