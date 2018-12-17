<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Artisan as Artisan;


class BillApiTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_fail_show_bill()
    {   
        $this->get('/api/v1/bill/14A',[])
                ->assertStatus(400)
                ->assertJson([
                                "error" => "Nao existem conta aberta para a mesa: 14A",
                            ]);
    }

    public function test_create_bill()
    {   
        $this->post('/api/v1/bill/',[     
                                        "number" => "14A",
                                    ])
                ->assertStatus(200)
                ->assertJson([
                                "message" => "Conta criada com sucesso",
                            ])
                            ;
    }

    public function test_add_first_product()
    {   
        $this->test_create_bill();
        $this->post('/api/v1/bill/14A/product',[     
                                            "product_id" => 1
                                    ])
                ->assertStatus(200)
                ->assertJson([
                                'message' => "Produto adicionado com sucesso" 
                            ]);
    }

    public function test_add_second_product()
    {   
        $this->test_create_bill();
        $this->post('/api/v1/bill/14A/product',[     
                                            "product_id" => 2
                                    ])
                ->assertStatus(200)
                ->assertJson([
                                'message' => "Produto adicionado com sucesso" 
                            ]);
    }

    public function test_show_new_itens()
    {   
        $this->test_add_first_product();
        $this->test_add_second_product();
        
        $this->get('/api/v1/bill/14A',[])
            ->assertStatus(200)
            ->assertJson( [ "id" => 1,
                            "balance" => "23.1",
                            "partial_balance" => "0",
                            "products" => 
                                            [
                                                [
                                                    "name" => "Cerveja Brahma",
                                                    "price" => "10.55",
                                                    "status" => "active",
                                                ],
                                                [
                                                    "name" => "Porcao Amendoim",
                                                    "price" => "12.55",
                                                    "status" => "active",
                                                ],
                                            ],
                            "board" => [
                            "number" => "14A",
                            "status" => "active",
                            ]
                        ] );    
    }

    public function test_pay_partial()
    {   
        $this->test_add_first_product();
        $this->test_add_second_product();
        
        $this->put('/api/v1/bill/14A/pay',[
                                        "quantity" => 5.50
                                     ])
            ->assertStatus(200)
            ->assertJson( ["message" => "Conta paga com sucesso" ] );    
    }
    
    public function test_pay_complete()
    {   
        $this->test_add_first_product();
        $this->test_add_second_product();
        
        $this->put('/api/v1/bill/14A/pay',[
                                        "quantity" => 23.1
                                     ])
            ->assertStatus(200)
            ->assertJson( ["message" => "Conta paga com sucesso" ] );    
    }

    public function see_partial_pay()
    {   
        $this->test_pay_partial();
       
        $this->get('/api/v1/bill/14A',[])
            ->assertStatus(200)
            ->assertJson( [ "id" => 1,
                            "balance" => "23.1",
                            "partial_balance" => "5.5",
                            "products" => 
                                            [
                                                [
                                                    "name" => "Cerveja Brahma",
                                                    "price" => "10.55",
                                                    "status" => "active",
                                                ],
                                                [
                                                    "name" => "Porcao Amendoim",
                                                    "price" => "12.55",
                                                    "status" => "active",
                                                ],
                                            ],
                            "board" => [
                            "number" => "14A",
                            "status" => "active",
                            ]
                        ] );    
    }

    public function see_complete_pay()
    {   
        $this->test_pay_complete();
       
        $this->get('/api/v1/bill/14A',[])
            ->assertStatus(200)
            ->assertJson( [ "id" => 1,
                            "balance" => "23.1",
                            "partial_balance" => "23.1",
                            "products" => 
                                            [
                                                [
                                                    "name" => "Cerveja Brahma",
                                                    "price" => "10.55",
                                                    "status" => "active",
                                                ],
                                                [
                                                    "name" => "Porcao Amendoim",
                                                    "price" => "12.55",
                                                    "status" => "active",
                                                ],
                                            ],
                            "board" => [
                            "number" => "14A",
                            "status" => "closed",
                            ]
                        ] );    
    }
    
    
    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
