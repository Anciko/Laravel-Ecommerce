<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
/*
For Api
    1. Get all categories with its subcats
    2. Get all tags
    3. Get paginated products
    4. Get products by category id
    5. Get products by subcategory id
    6. Get products by tag id
    7. Order upload
    8. Get my order
    9. Get orderitems
For Admin
    1. See all orders
    2. See all orderitems
 */

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
Route::get('/cats', [ApiController::class, 'getAllCats']);
Route::get('/subcats/{id}', [ApiController::class, 'getSubcats'] );
Route::get('/tags', [ApiController::class, 'tags']);
Route::get('/products', [ApiController::class, 'products']);
Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('/me', [ApiController::class, 'me']);
});
