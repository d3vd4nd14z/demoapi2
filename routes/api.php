<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\CategoriasController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::Class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/user-profile', [AuthController::class, 'userProfile']);
    
    Route::get('/articulos', [ArticulosController::class, 'getArticulos']);
    Route::get('/articulo/{id}', [ArticulosController::class, 'getArticulo']);
    Route::post('/articulos', [ArticulosController::class, 'createArticulo']);    
    Route::put('/articulo/{id}', [ArticulosController::class, 'updateArticulo']);
    Route::delete('/articulo/{id}', [ArticulosController::class, 'deleteArticulo']);

    Route::get('/autores', [AutoresController::class, 'getAutores']);
    Route::get('/autor/{id}', [AutoresController::class, 'getAutor']);
    Route::post('/autores', [AutoresController::class, 'createAutor']);
    Route::put('/autor/{id}', [AutoresController::class, 'updateAutor']);
    Route::delete('/autor/{id}', [AutoresController::class, 'deleteAutor']);

    Route::get('/categorias', [CategoriasController::class, 'getCategorias']);
    Route::get('/categoria/{id}', [CategoriasController::class, 'getCategoria']);
    Route::post('/categorias', [CategoriasController::class, 'createCategoria']);
    Route::put('/categoria/{id}', [CategoriasController::class, 'updateCategoria']);
    Route::delete('/categoria/{id}', [CategoriasController::class, 'deleteCategoria']);


});
