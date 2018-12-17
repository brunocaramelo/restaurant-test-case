<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1'], function () 
{
    Route::group(['prefix' => 'products'], function () 
    {
        Route::get('/',
                        [ 'as' => 'products-list', 
                        'uses' => '\Admin\Products\Controllers\ProductsController@listAll' 
                    ]);
        
    });

    Route::group(['prefix' => 'product'], function () 
    {
        Route::get('/{id}',
        [ 'as' => 'view-product', 
            'uses' => '\Admin\Products\Controllers\ProductsController@findById' 
        ]);

    });
    Route::group(['prefix' => 'boards'], function () 
    {
        Route::get('/',
                        [ 'as' => 'boards-list', 
                        'uses' => '\Admin\Boards\Controllers\BoardsController@listAll' 
                    ]);
        
    });

    Route::group(['prefix' => 'board'], function () 
    {
        Route::get('/{id}',
        [ 'as' => 'view-product', 
            'uses' => '\Admin\Boards\Controllers\BoardsController@findById' 
        ]);

    });

    Route::group(['prefix' => 'bill'], function () 
    {
        Route::post('/',
                            [ 'as' => 'create-bill', 
                            'uses' => '\Admin\Bills\Controllers\BillsController@create' 
                            ]);

        Route::get('/{number}',
                            [ 'as' => 'see-bill', 
                            'uses' => '\Admin\Bills\Controllers\BillsController@findByNumberBoard' 
                            ]);

        Route::put('/{number}/pay',
                            [ 'as' => 'pay-bill', 
                            'uses' => '\Admin\Bills\Controllers\BillsController@payBill' 
                            ]);
        
        Route::post('/{number}/product',
                            [ 'as' => 'add-product', 
                            'uses' => '\Admin\Bills\Controllers\BillsController@addProduct' 
                            ]);

    });

});
    