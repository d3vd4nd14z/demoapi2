<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Autor;

class AutoresController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function getAutores(){
        $autor = new Autor();
        $data = $autor->getAutoresAll();
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

    public function getAutor(int $id){
        $autor = new Autor();
        $data = $autor->getAutorById($id);                
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

    public function createAutor(Request $request){        
        $autor = new Autor();        
        $data = $autor->saveAutor($request);                
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

    public function updateAutor(int $id, Request $request){
        $autor = new Autor();
        $data = $autor->updateAutor($id, $request);        
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

    public function deleteAutor(int $id){
        $autor = new Autor();
        $data = $autor->deleteAutor($id);
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
