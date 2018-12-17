<?php

use Illuminate\Database\Seeder;

use Admin\Boards\Entities\BoardEntity as Board;

class BoardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Board::firstOrCreate([
            'id' => '1',
            'number' => '14A',
        ]);
        Board::firstOrCreate([
            'id' => '2',
            'number' => '10A',
        ]);
        Board::firstOrCreate([
            'id' => '3',
            'number' => '10B',
        ]);
        Board::firstOrCreate([
            'id' => '4',
            'number' => '4A',
        ]);
        Board::firstOrCreate([
            'id' => '5',
            'number' => '5A',
        ]);

        // \Admin\Bills\Entities\BillEntity::firstOrCreate([
        //     'id' => '1',
        //     'board_id' => '1',
        //     'balance' => '0.00',
        //     'partial_balance' => '0.00',
        // ]);
        
        // \Admin\Bills\Entities\BillItemEntity::firstOrCreate([
        //     'id' => '1',
        //     'bill_id' => '1',
        //     'product_id' => '1',
        // ]);
        // \Admin\Bills\Entities\BillItemEntity::firstOrCreate([
        //     'id' => '2',
        //     'bill_id' => '1',
        //     'product_id' => '2',
        // ]);

    }
}
