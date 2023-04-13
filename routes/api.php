<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ApiMovilController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::post('/register', [ApiRegisteredUserController::class, 'store']);
Route::get('/monumentos/{id}/modal', [ApiMovilController::class, 'mostrarModalMonumentos']);
Route::get('/monumentos/{id}/comentarios/{limit}', [ApiMovilController::class, 'mostrarComentariosMonumentos']);
Route::get('/monumentos/{id}/comentarios/total', [ApiMovilController::class, 'totalComentariosMonumentos']);
Route::post('/comentarios', [ApiMovilController::class, 'guardarComentario']);

//registro y logeo
Route::post('/register', [ApiMovilController::class, 'register']);
Route::post('/login', [ApiMovilController::class, 'login']);

//proteccion 
route::group(['middleware' => ['auth:sanctum']], function(){
   //usuario
   Route::get('/user', [ApiMovilController::class, 'user']);
   Route::post('/logout', [ApiMovilController::class, 'logout']);
});