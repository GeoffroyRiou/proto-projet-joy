<?php

use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\Auth\AuthLogoutController;
use App\Http\Controllers\WorkTool\IndexController;
use App\Http\Controllers\WorkTool\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', AuthLoginController::class)->name('api.auth.login');

Route::get('/worktools', IndexController::class)->name('api.worktools.index');

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/login', AuthLogoutController::class)->name('api.auth.logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/worktools/store', StoreController::class)->name('api.worktools.store');
});
