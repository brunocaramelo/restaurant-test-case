<?php

namespace Admin\Bills\Validators;
use Validator;

class BillsValidator{
    
    private $redirect = false;
    private $messages = false;
    
    public function __construct( $redirect = false )
    {
        $this->redirect = $redirect;
        $this->setMessages();
    }

    public function validateCreate( $fields )
    {
      return $this->make( $fields , [
                                        'board_id' => 'required',
                                    ]);
    }

    public function validateUpdate( $fields )
    {
       return $this->make( $fields , [
                                        'board_id' => 'required',
                                    ]);
    }

    public function make( $fields , $rules )
    {
        $validate =  Validator::make( $fields , $rules , $this->messages );
        if($this->redirect === true)
            return $validate->validate();
        return $validate;
    }

    private function setMessages()
    {
        $this->messages = [
                            'board_id.required'=>'E necessario informar o numero da mesa',
                            ];
    }


}