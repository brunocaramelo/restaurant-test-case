<?php 

namespace Admin\Bills\Repositories;

use Admin\Bills\Entities\BillEntity;

class BillsRepository
{
    private $bill = null;

    public function __construct( BillEntity $bill )
    {
        $this->bill = $bill;
    }

    public function getList()
    {
        $query = $this->bill->select(
                                'us.id as id',
                                'us.balance as balance',
                                'us.partial_balance as partial_balance',
                                'us.board_id as board_id'
                                )
                            ->from('bills AS us')
                            ->where( 'us.status' , '=' , 'active' );
        return $query;
    }

    public function find( $identify )
    {
        return $this->bill->find( $identify );
    }

    public function findActive( $identify )
    {
        return $this->bill->where( 'id', $identify )->active()->first();
    }

  
    public function findBy( $field , $value )
    {
        return $this->bill->where( $field , $value );
    }

    public function findActiveByBoardCode( $number )
    {
        return  $this->bill->active()
                        ->whereHas('board', function( $query ) use( $number ) {
                            $query->where('number', '=', $number );
                        })->first();
                                        
    }
    
    
    public function create( $data )
    {
        return $this->bill->create( $data );
    }

    public function update( $identify , $data )
    {
        $billSave = $this->bill->find( $identify );
        return $billSave->fill( $data )->save();
    }
    
    public function addProduct( $identify , $product )
    {
        $billSave = $this->findActive( $identify );
        
        $billSave->itens()->create(
                                            [ 
                                                'product_id' => $product->id,
                                                'bill_id' => $billSave->id,
                                            ]
                                          );
        $billSave->balance =  ( $billSave->balance + $product->price ); 
        return $billSave->save();
    }

}