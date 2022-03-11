<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function getCategorias(){
        $categorias = new Categoria();
        $data = $categorias->getCategoriasAll();
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

    public function getCategoria(int $id){
        $categoria = new Categoria();
        $data = $categoria->getCategoriaById($id);                
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

    public function createCategoria(Request $request){        
        $categoria = new Categoria();        
        $data = $categoria->saveCategoria($request);                
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

    public function updateCategoria(int $id, Request $request){
        $categoria = new Categoria();
        $data = $categoria->updateCategoria($id, $request);        
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

    public function deleteCategoria(int $id){
        $categoria = new Categoria();
        $data = $categoria->deleteCategoria($id);
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
