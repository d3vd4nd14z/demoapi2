<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Articulo;


class ArticulosController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function getArticulos(){
        $articulos = new Articulo();
        $data = $articulos->getArticulosAll();
        if (!$data->isEmpty()){
            return response()->json([
                'code' => 200,
                'data' => $data,
                'message' => "Operation Success (OK)"
            ], 200);
        }
        else{
            return response()->json([
                'code' => 404,
                'data' => null,
                'message' => "Not Found"
            ], 404);

        }        
    }

    public function getArticulo(int $id){
        $articulos = new Articulo();
        $data = $articulos->getArticuloById($id);                
        if (!$data->isEmpty()){
            return response()->json([
                'code' => 200,
                'data' => $data,
                'message' => "Operation Success (OK)"
            ], 200);    
        }
        else{
            return response()->json([
                'code' => 404,
                'data' => null,
                'message' => "Not Found"
            ], 404);
        }        
    }

    public function createArticulo(Request $request){        
        $articulo = new Articulo();        
        $data = $articulo->saveArticulo($request);
        if (!is_null($data)){
            return response()->json([
                'code' => 200,
                'data' => $data,
                'message' => "Operation Success (OK)"
            ], 200);
        }
        else{
            return response()->json([
                'code' => 500,
                'data' => null,
                'message' => "Internal Server Error (ERROR)"
            ], 500);
        }
    }

    public function updateArticulo(int $id, Request $request){
        $articulo = new Articulo();
        $data = $articulo->updateArticulo($id, $request);        
        if (!is_null($data)){
            return response()->json([
                'code' => 200,
                'data' => $data,
                'message' => "Operation Success (OK)"
            ], 200);
        }
        else{
            return response()->json([
                'code' => 404,
                'data' => null,
                'message' => "Not Found"
            ], 404);
        }
    }

    public function deleteArticulo(int $id){
        $articulo = new Articulo();
        $data = $articulo->deleteArticulo($id);
        if (!is_null($data)){
            return response()->json([
                'code' => 200,
                'data' => $data,
                'message' => "Operation Success (OK)"
            ], 200);
        }
        else{
            return response()->json([
                'code' => 404,
                'data' => null,
                'message' => "Not Found"
            ], 404);
        }
    }

    
    
}
