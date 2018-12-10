<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Artisan as Artisan;


class ProductApiTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

   
    public function test_get_one_product()
    {
        $this->get('/api/v1/product/5',[ ] )
        ->assertStatus(200)
        ->assertJson(
                [
                    "id"=> 5,
                    "name"=> "Suco",
                    "price"=> "9.15",
                    "status"=> "active"
                ]
            );
    }   

    public function test_get_all_products()
    {   
        $this->get('/api/v1/products/',[ ] )
                ->assertStatus(200)
                ->assertJson([
                    [
                        "id"=> 1,
                        "name"=> "Cerveja Brahma",
                        "price"=> "10.55"
                    ],
                    [
                        "id"=> 2,
                        "name"=> "Porcao Amendoim",
                        "price"=> "12.55"
                    ],
                    [
                        "id"=> 3,
                        "name"=> "Porcao Batata",
                        "price"=> "12.65"
                    ],
                    [
                        "id"=> 4,
                        "name"=> "Cerveja Skoll",
                        "price"=> "11.45"
                    ],
                    [
                        "id"=> 5,
                        "name"=> "Suco",
                        "price"=> "9.15"
                    ]
                
                             ]);
    }
   
    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
