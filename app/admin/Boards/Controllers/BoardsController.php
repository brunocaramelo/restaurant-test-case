<?php

namespace Admin\Boards\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Admin\Boards\Services\BoardService;

class BoardsController extends Controller
{
    public function __construct()
    {
    }
  
    public function listAll()
    {
        $service = new BoardService();
        return response()->json( $service->getList() );
    }
    
    public function findById( Request $request )
    {
        $service = new BoardService();
        return response()->json( $service->edit( $request->id ) );
    }
}
