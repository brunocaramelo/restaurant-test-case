<?php

namespace Admin\Boards\Entities;
use \Illuminate\Database\Eloquent\Model;

class BoardEntity extends Model
{
    protected $table = 'boards';
    
    protected $fillable = [
                            'number', 
                            'status',
                        ];

}
