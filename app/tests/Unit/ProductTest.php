<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan as Artisan;

use Admin\Products\Services\ProductService;

class ProductTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_list_prod_default()
    {
        $expected =  $this->return_list_seed_result();
                    
        $prodService = new ProductService();
       
        $this->assertEquals( $prodService->getList()->toArray() , $expected );
    }


    public function test_show_prod()
    {
        $expected = [
                        "id"=> 1,
                        "name"=> "Cerveja Brahma",
                        "price"=> "10.55",
                        'status' => 'active'
                    ];

        $prodService = new ProductService();
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
        ];
        
    }
}
