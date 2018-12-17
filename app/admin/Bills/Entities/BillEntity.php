<?php

namespace Admin\Bills\Entities;

use Illuminate\Database\Eloquent\Model;

class BillEntity extends Model
{
    protected $table = 'bills';
    
    protected $fillable = [
                            'balance', 
                            'partial_balance',
                            'board_id',
                        ];
    
    public function itens()
    {
        return $this->hasMany( \Admin\Bills\Entities\BillItemEntity::class , 'bill_id' );
    }
    
    public function products()
    {
        return $this->belongsToMany(\Admin\Bills\Entities\BillItemEntity::class , 'bill_id')
        ->withPivot('product_id');
    }

    public function board()
    {
        return $this->belongsTo( \Admin\Boards\Entities\BoardEntity::class );
    }

    public function scopeActive($query)
    {
        return $query->where('active', '=', 'active');
    }
}
