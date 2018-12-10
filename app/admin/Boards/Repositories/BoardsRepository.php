<?php 

namespace Admin\Boards\Repositories;

use Admin\Boards\Entities\BoardEntity;

class BoardsRepository
{
    private $car = null;

    public function __construct( BoardEntity $employee )
    {
        $this->board = $employee;
    }

    public function getList()
    {
        $query = $this->board->select(
                                'us.id as id',
                                'us.number as number'
                                )
                            ->from('boards AS us')
                            ->where( 'us.status' , '=' , 'active' );
        return $query;
    }

    public function find( $identify )
    {
        return $this->board->find( $identify );
    }

    public function findBy( $field , $value )
    {
        return $this->board->where( $field , $value );
    }

}