<?php

namespace Admin\Bills\Entities;

use Illuminate\Database\Eloquent\Model;

class BillEntity extends Model
{
    protected $table = 'bills';
    
    protected $fillable = [
                            'name', 
                            'balance', 
                            'partial_balance',
                            'board_id',
                        ];
    
    public function itens()
    {
        return $this->hasMany( \Admin\Bills\Entities\BillItemEntity::class );
    }
}
