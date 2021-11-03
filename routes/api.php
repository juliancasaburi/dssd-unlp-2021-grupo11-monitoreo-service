<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

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

/* Auth */

/* JWT protected routes */
Route::group(['middleware' => ['apiJwt']], function () {
    Route::get('users', [UserController::class, 'index']);
});

/* Bonita token protected routes */
Route::group(['middleware' => ['bonitaProtectedRoute']], function () {
    /* Auth */
    Route::post('auth/logout', [AuthController::class, 'logout']);
});
