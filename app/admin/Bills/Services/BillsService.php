<?php

namespace Admin\Bills\Services;

use Admin\Bills\Models\BillModel;

class BillsService
{
    private $billModel = null;
    
    public function __construct()
    {
        $this->billModel = new BillModel();
    }

    public function getList()
    {
        return $this->billModel->getList();
    }

    public function createByBoardCode( $code )
    {
        return $this->billModel->createByBoardCode( $code );
    }

    public function find( $identify )
    {
        return $this->billModel->find( $identify );
    }

    public function findActiveByBoardCode( $boardNumber )
    {
        return $this->billModel->findActiveByBoardCode( $boardNumber );
    }
    
    public function addProductToBill( $boardNumber , \Admin\Products\Entities\ProductEntity $product )
    {
        return $this->billModel->addProductToBill( $boardNumber , $product );
    }

    public function pay( $boardNumber ,  $quantity )
    {
        return $this->billModel->pay( $boardNumber , $quantity );
    }

}