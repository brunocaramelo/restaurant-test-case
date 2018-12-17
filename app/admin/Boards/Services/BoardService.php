<?php

namespace Admin\Boards\Services;

use Admin\Boards\Models\BoardsModel;

class BoardService
{
    private $boardModel = null;
    
    public function __construct()
    {
        $this->boardModel = new BoardsModel();
    }

    public function getList()
    {
        return $this->boardModel->getList();
    }

    public function edit( $identify )
    {
        return $this->boardModel->edit( $identify );
    }

    public function find( $identify )
    {
        return $this->boardModel->find( $identify );
    }

    public function findByNumber( $value )
    {
        return $this->boardModel->findByNumber( $value );
    }

}