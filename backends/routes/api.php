<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\IbanController;

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

Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class ,'loginUser'])->name('login');
    Route::post('/register', [RegisterController::class,'createUser'])->name('createUser');
    Route::post('/ibans/check', [IbanController::class, 'validateIban'])->name('validateIban');
    Route::get('/users/ibans/list',[IbanController::class, 'ibanUsersList'])->name('ibanUsersList');
    
    Route::middleware(['auth:sanctum'])->group(function () {
        // Route::get('/users',[UserController::class,'getAlluser']);
        Route::post('/logout', LogoutController::class);   
    });
});


