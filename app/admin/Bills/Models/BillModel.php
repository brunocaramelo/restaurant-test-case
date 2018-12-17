<?php

namespace Admin\Bills\Models;

use Illuminate\Support\Facades\Hash;

use Admin\Bills\Validators\BillsValidator;
use Admin\Bills\Exceptions\BillEditException;
use Admin\Bills\Entities\BillEntity;
use Admin\Bills\Repositories\BillsRepository;
use Admin\Boards\Services\BoardService;

class BillModel
{
    private $billRepo = null;
    
    public function __construct()
    {
        $this->billRepo = new BillsRepository( new BillEntity() );
    }

    public function createByBoardCode( $code )
    {
        return $this->billRepo->create( 
                                        [ 
                                            'board_id' => $this->getBoardIdByNumber( $code ) 
                                        ] 
                                    );
    }

    public function addProductToBill( $code , \Admin\Products\Entities\ProductEntity $product )
    {
        return $this->billRepo->addProduct( $this->getBoardIdByNumber( $code ) , 
                                            $product );
    }

    public function find( $identify )
    {
        return $this->billRepo->find( $identify );
    }
    public function findActive( $identify )
    {
        return $this->billRepo->findActive( $identify );
    }

    public function findByCode( $value )
    {
        return $this->findBy( 'number' , $value );
    }

    public function findBy( $field , $value )
    {
        return $this->billRepo->findBy( $field , $value )->first();
    }

    public function findActiveByBoardCode( $field )
    {
        return $this->billRepo->findActiveByBoardCode( $field );
    }

    private function getBoardIdByNumber( $code )
    {
        $boardService = new BoardService();
        $boardSource = $boardService->findByNumber( $code );
        if(! $boardSource  instanceof \Admin\Boards\Entities\BoardEntity )
            throw new BillEditException( "Mesa $code inexistente" );
        return $boardSource->id;
    }

    public function pay( $code , $quantity )
    {
        $actual = $this->findActive( $this->getBoardIdByNumber( $code ) );
        $isFullPayment = ( $quantity >= $actual->balance );
        
        $updateParams['status'] = ( $isFullPayment === true ? 'closed' : $actual->status );
        $updateParams['partial_balance'] = ( $isFullPayment === true ? 0.00 : $quantity );
        
        $this->billRepo->update( $actual->id , $updateParams );
 
    }

}