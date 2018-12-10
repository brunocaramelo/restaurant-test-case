<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Artisan as Artisan;


class BoardApiTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

   
    public function test_get_one_board()
    {
        $this->get('/api/v1/board/5',[ ] )
        ->assertStatus(200)
        ->assertJson(
                [
                    "id"=> 5,
                    "number"=> "5A",
                    "status"=> "active"
                ]
            );
    }   

    public function test_get_all_boards()
    {   
        $this->get('/api/v1/boards/',[ ] )
                ->assertStatus(200)
                ->assertJson([
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
                ]);
    }
   
    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
