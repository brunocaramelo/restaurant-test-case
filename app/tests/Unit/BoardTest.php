<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan as Artisan;

use Admin\Boards\Services\BoardService;

class BoardTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_list_board_default()
    {
        $expected =  $this->return_list_seed_result();
                    
        $prodService = new BoardService();
        $this->assertEquals( $prodService->getList()->toArray() , $expected );
    }


    public function test_show_prod()
    {
        $expected = [
                    'id' => 1,
                    'number' => '14A',
                    'status' => 'active',
                    ];

        $prodService = new BoardService();
        $final = $prodService->edit( 1 )->toArray();
        
        $this->assertEquals( $final , $expected );
    }


    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    private function return_list_seed_result()
    {
        return [
            [
                "id"=> 1,
                "number"=> "14A"
            ],
            [
                "id"=> 2,
                "number"=> "10A"
            ],
            [
                "id"=> 3,
                "number"=> "10B",
            ],
            [
                "id"=> 4,
                "number"=> "4A",
            ],
            [
                "id"=> 5,
                "number"=> "5A",
            ]
        ];
        
        
    }
}
