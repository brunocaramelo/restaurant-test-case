<?php

namespace Admin\Boards\Models;

use Admin\Boards\Repositories\BoardsRepository;
use Admin\Boards\Entities\BoardEntity;

class BoardsModel
{
    private $empRepo = null;
    
    public function __construct()
    {
        $this->board = new BoardsRepository( new BoardEntity() );
    }

    public function getList()
    {
        return $this->board->getList()->get();
    }

    public function edit( $identify )
    {
        $edit = $this->find( $identify );
        unset( $edit['created_at'], $edit['updated_at'] , $edit['api_token'] );
        return $edit;
    }

    public function find( $identify )
    {
        return $this->board->find( $identify );
    }

    public function findByNumber( $value )
    {
        return $this->board->findBy( 'number' , $value );
    }
}