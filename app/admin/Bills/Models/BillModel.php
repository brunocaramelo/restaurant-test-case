<?php

namespace Admin\Bills\Models;

use Illuminate\Support\Facades\Hash;

use Admin\Bills\Validators\BillsValidator;
use Admin\Bills\Exceptions\BillEditException;
use Admin\Bills\Entities\BillEntity;
use Admin\Bills\Repositories\BillsRepository;

class BillModel
{
    private $billRepo = null;
    
    public function __construct()
    {
        $this->billRepo = new BillsRepository( new BillEntity() );
    }

    public function getList()
    {
        return $this->billRepo->getList();
    }

    public function create( array $data )
    {
        $validate = new BillsValidator();
        $validation = $validate->validateCreate( $data );
        if( $validation->fails() )
            throw new BillEditException( implode( "\n" , $validation->errors()->all() ) );
        return $this->billRepo->create( $data );
    }

    public function update( $identify , array $data )
    {
        $validate = new BillsValidator();
        $validation = $validate->validateUpdate( $data );
        if( $validation->fails() )
            throw new BillEditException( implode( "\n" , $validation->errors()->all() ) );
        return $this->billRepo->update( $identify , $data );
    }

    public function edit( $identify )
    {
        $edit = $this->find( $identify );
        unset( $edit['created_at'], $edit['updated_at'] , $edit['api_token'] );
        return $edit;
    }

    public function find( $identify )
    {
        return $this->billRepo->find( $identify );
    }

    public function findByCode( $value )
    {
        return $this->findBy( 'code' , $value );
    }

    public function findBy( $field , $value )
    {
        return $this->billRepo->findBy( $field , $value )->first();
    }

}