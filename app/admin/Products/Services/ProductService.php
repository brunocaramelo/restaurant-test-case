<?php

namespace Admin\Products\Services;

use Admin\Products\Models\ProductsModel;

class ProductService
{
    private $productModel = null;
    
    public function __construct()
    {
        $this->productModel = new ProductsModel();
    }

    public function getList()
    {
        return $this->productModel->getList();
    }

    public function edit( $identify )
    {
        return $this->productModel->edit( $identify );
    }

    public function find( $identify )
    {
        return $this->productModel->find( $identify );
    }

    public function findByCode( $value )
    {
        return $this->findByCode( $value );
    }

}