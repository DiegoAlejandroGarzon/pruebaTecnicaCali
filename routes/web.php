<?php

use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [userController::class, 'index'])->name('dashboard');
    Route::group(['middleware' => ['role:Administrator']], function () {
        Route::post('/createUser', [userController::class, 'create']);
        Route::get('/usersList', [userController::class, 'list']);
        Route::post('/updateUser', [userController::class, 'update']);
        Route::post('/deleteUser/{id}', [userController::class, 'delete']);
    });
});


require __DIR__.'/auth.php';
