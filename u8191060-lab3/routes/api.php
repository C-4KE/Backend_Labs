<?php

use App\Http\ApiV1\Modules\Archive\Controllers\BookcasesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\ApiV1\Modules\Archive\Controllers\BooksController;

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

Route::get('v1/books/{id}', [BooksController::class, 'getById']);

Route::get('v1/books', [BooksController::class, 'get']);

Route::delete('v1/books/{id}', [BooksController::class, 'delete']);

Route::post('v1/books', [BooksController::class, 'post']);

Route::patch('v1/books/{id}', [BooksController::class, 'patch']);

Route::put('v1/books/{id}', [BooksController::class, 'put']);

Route::get('v1/bookcases', [BookcasesController::class, 'get']);

Route::get('v1/bookcases/{id}', [BookcasesController::class, 'getById']);