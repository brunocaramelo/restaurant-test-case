<?php

namespace Admin\Products\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Admin\Products\Services\ProductService;

class ProductsController extends Controller
{
    public function __construct()
    {
    }
  
    public function listAll()
    {
       $service = new ProductService();
         return response()->json( $service->getList() );
    }
    
    public function findById( Request $request )
    {
        $service = new ProductService();
        return response()->json( $service->edit( $request->id ) );
    }
}
