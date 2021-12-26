<?php

use App\Http\Controllers\Api\ApiController;
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


Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
Route::get('/cats', [ApiController::class, 'getAllCats']);
Route::get('/subcats/{id}', [ApiController::class, 'getSubcats'] );
Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('/me', [ApiController::class, 'me']);
});
