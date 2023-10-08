<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group([
    'prefix' => 'tasks',
    'as' => 'tasks',
    'middleware' => 'auth',
], function () {
    Route::get('/list', [TaskController::class, 'list'])
        ->name('.list');

    Route::post('/create', [TaskController::class, 'create'])
        ->name('.create');

    Route::post('/delete', [TaskController::class, 'delete'])
        ->name('.delete');
});
