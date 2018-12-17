<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan as Artisan;

use Admin\Bills\Services\BillBoard;
use Admin\Products\Services\ProductService;

class BillTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    /**
     * @expectedException        \Admin\Bills\Exceptions\BillExistenceException
     * @expectedExceptionMessage Nao existem conta aberta para a mesa: 14A
     */
    public function test_fail_bill()
    {
        $expected = [];
        $boardNumber = '14A';
        $billService = new BillBoard( $boardNumber );
        $billService->getData();
    }

    public function test_open_bill()
    {
        $expected = [
                        'id' => 1,
                        'balance' => '0',
                        'partial_balance' => '0',
                        'products' => [],
                        'board' => [
                                    'number' => '14A',
                                    'status' => 'active',
                                    ]
                    ];

        $boardNumber = '14A';
        $billService = new BillBoard( $boardNumber );
        $billService->open();
        $this->assertEquals( $billService->getData() , $expected );
    }


    public function test_add_first_prod()
    {
        $this->test_open_bill();
        
        $expected = ["id" => 1,
                        "balance" => "10.55",
                        "partial_balance" => "0",
                        "products" => 
                                        [
                                            [
                                                "name" => "Cerveja Brahma",
                                                "price" => "10.55",
                                                "status" => "active",
                                            ]
                                        ],
                        "board" => [
                        "number" => "14A",
                        "status" => "active",
                        ]
                    ];

        $prodService = new ProductService();
        $prodInstance = $prodService->edit( 1 );

        $boardNumber = '14A';
        $billService = new BillBoard( $boardNumber );
        $billService->addProduct( $prodInstance );
        $this->assertEquals( $billService->getData() , $expected );
    }

    public function test_add_second_prod()
    {
        $this->test_add_first_prod();
        
        $expected = ["id" => 1,
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
                    ];

        $prodService = new ProductService();
        $prodInstance = $prodService->edit( 2 );

        $boardNumber = '14A';
        $billService = new BillBoard( $boardNumber );
        $billService->addProduct( $prodInstance );
        $this->assertEquals( $billService->getData() , $expected );
    }
    
    public function test_partial_pay()
    {
        $this->test_add_first_prod();
        $expected = ["id" => 1,
                        "balance" => "10.55",
                        "partial_balance" => "5.5",
                        "products" => 
                                        [
                                            [
                                                "name" => "Cerveja Brahma",
                                                "price" => "10.55",
                                                "status" => "active",
                                            ]
                                        ],
                        "board" => [
                        "number" => "14A",
                        "status" => "active",
                        ]
                    ];
        
        $boardNumber = '14A';
        $quantity = 5.50;
        
        $billService = new BillBoard( $boardNumber );
        $billService->pay( $quantity );
        $this->assertEquals( $billService->getData() , $expected );
    }

    public function test_complete_pay()
    {
        $this->test_add_second_prod();
        $expected = ["id" => 1,
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
                ];
        
        $boardNumber = '14A';
        $quantity = 23.1;
        
        $billService = new BillBoard( $boardNumber );
        $billService->pay( $quantity );
        $this->assertEquals( $billService->getData() , $expected );
    }

    // public function tearDown()
    // {
    //     Artisan::call('migrate:reset');
    //     parent::tearDown();
    // }

    // private function return_list_seed_result()
    // {
    //     return [
    //         [
    //             "id"=> 1,
    //             "number"=> "14A"
    //         ],
    //         [
    //             "id"=> 2,
    //             "number"=> "10A"
    //         ],
    //         [
    //             "id"=> 3,
    //             "number"=> "10B",
    //         ],
    //         [
    //             "id"=> 4,
    //             "number"=> "4A",
    //         ],
    //         [
    //             "id"=> 5,
    //             "number"=> "5A",
    //         ]
    //     ];
        
        
    // }
}
