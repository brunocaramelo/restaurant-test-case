<?php

namespace Admin\Bills\Services;

use Admin\Bills\Services\BillsService;
use Admin\Bills\Resources\BillResource;
use Admin\Bills\Exceptions\BillExistenceException;
use Admin\Products\Entities\ProductEntity;

class BillBoard
{
    private $boardNumber = null;
    private $billService = null;

    public function __construct( $boardNumber )
    {
        $this->boardNumber = $boardNumber;
        $this->billService = new BillsService();
    }

    public function get()
    {
        return $this->getActiveBillByBoard();
    }
    
    public function getData()
    {
        $this->checkExistence();
        return ( new BillResource( $this->getActiveBillByBoard() ) )->toArray([]);
    }

    private function getActiveBillByBoard()
    {
       return $this->billService->findActiveByBoardCode( $this->boardNumber );
    }
    
    private function checkExistence()
    {
       if(! $this->getActiveBillByBoard() instanceof \Admin\Bills\Entities\BillEntity )
            throw new BillExistenceException('Nao existem conta aberta para a mesa: '.$this->boardNumber);
    }

    public function open()
    {
        $this->billService->createByBoardCode( $this->boardNumber );
    }
    
    public function addProduct( ProductEntity $product )
    {
        $this->billService->addProductToBill( $this->boardNumber ,  $product );
    }
    
    public function pay( $quantity )
    {
        $this->billService->pay( $this->boardNumber ,  $quantity );
    }


}