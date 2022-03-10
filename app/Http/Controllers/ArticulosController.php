<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Articulos;


class ArticulosController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function getArticulos(){
        $articulos = new Articulos();
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
        $articulos = new Articulos();
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
        $articulo = new Articulos();        
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
        $articulo = new Articulos();
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
        $articulo = new Articulos();
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
