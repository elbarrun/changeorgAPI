<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeticionesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/peticiones/listado', [PeticionesController::class, 'list']);
Route::post('/peticiones/create', [PeticionesController::class, 'store']);
Route::get( '/peticiones/show/{id}', [PeticionesController::class, 'show']);
Route::put('/peticiones/update/{id}', [PeticionesController::class, 'update']);
Route::delete('/peticiones/destroy/{id}', [PeticionesController::class, 'destroy']);
Route::get('/peticiones/firmar/{id}', [PeticionesController::class, 'firmar']);
Route::put('/peticiones/estado/{id}', [PeticionesController::class, 'cambiarEstado']);
Route::get('/mispeticiones/',[PeticionesController::class, 'listMine']);
//Route::get('/users/firmas', [\App\Http\Controllers\UsersController::class, 'peticionesFirmadas']);
Route::resource('peticiones', PeticionesController::class);

Route::post('/peticiones/',[PeticionesController::class, 'store'])->middleware(['auth']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('user-profile', 'me');
});

