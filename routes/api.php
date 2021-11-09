<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProcessController;
use App\Http\Controllers\Api\CaseController;
use App\Http\Controllers\Api\StatsController;

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

Route::post('auth/login', [AuthController::class, 'login']);

/* JWT protected routes */
Route::group(['middleware' => ['apiJwt']], function () {
    Route::get('users', [UserController::class, 'index']);
});

/* Bonita token protected routes */
Route::group(['middleware' => ['bonitaProtectedRoute']], function () {
    /* Auth */
    Route::post('auth/logout', [AuthController::class, 'logout']);

    /* User */
    Route::get('user', [UserController::class, 'getUsers']);

    /* Process */
    Route::get('process', [ProcessController::class, 'getProcesses']);

    /* Case */
    Route::get('activeCase', [CaseController::class, 'getActiveCases']);
    Route::get('archivedCase', [CaseController::class, 'getArchivedCases']);
    Route::get('activeCaseCount', [CaseController::class, 'getActiveCaseCount']);
    Route::get('averageCaseTime', [CaseController::class, 'getAverageCaseTime']);

    /* Stats */
    Route::get('stats/cantidadRechazosLegales', [StatsController::class, 'getcantidadRechazosLegales']);
    Route::get('stats/cantidadRechazosMesaEntradas', [StatsController::class, 'getcantidadRechazosMesaEntradas']);
});
