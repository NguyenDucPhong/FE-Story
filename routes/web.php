<?php


use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'showlogin'])->name('login');
Route::get('/register', [UserController::class, 'showregister'])->name('register');
Route::post('/register', [UserController::class, 'register']);


Route::get('/activate/{token}', [UserController::class, 'activate'])->name('activate');
Route::post('/', [UserController::class, 'login']);


