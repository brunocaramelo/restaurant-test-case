<?php

namespace Admin\Bills\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Admin\Bills\Services\BillBoard;
use Admin\Products\Services\ProductService;
use Admin\Bills\Exceptions\BillExistenceException;

class BillsController extends Controller
{
    public function __construct()
    {
    }
  
    public function findByNumberBoard( Request $request )
    {
        try{  
            $billService = new BillBoard( $request->number );
            return response()->json( $billService->getData() );
        }catch( BillExistenceException $error ){
            return response()->json( [  'error'=> $error->getMessage() ] ,400);
        }
    }

    public function create( Request $request )
    {
        $return = ['message'=> null];
        try{        
            \DB::beginTransaction();

            $billService = new BillBoard( $request->number );
            $billService->open();
            
            $return['message'] = 'Conta criada com sucesso';
            \DB::commit();
            return response()->json( $return );
        }catch( BillExistenceException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }
    
    public function payBill( Request $request )
    {
        $return = ['message'=> null];
        try{        
            \DB::beginTransaction();
            $quantity = ( float ) $request->quantity;

            $billService = new BillBoard( $request->number );
            $billService->pay( $quantity );
            
            \DB::commit();
            $return['message'] = 'Conta paga com sucesso';
            return response()->json( $return );
        }catch( BillExistenceException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }

    public function addProduct( Request $request )
    {
        $return = ['message'=> null];
        try{        
            \DB::beginTransaction();
            $quantity = ( float ) $request->quantity;

            $billService = new BillBoard( $request->number );
            
            $prodService = new ProductService();
            $prodInstance = $prodService->edit( $request->product_id );

            $billService->addProduct( $prodInstance );
            
            \DB::commit();
            $return['message'] = 'Produto adicionado com sucesso';
            return response()->json( $return );
        }catch( BillExistenceException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }
    
    
    
}
