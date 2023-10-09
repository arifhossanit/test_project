<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', [TransactionController::class, 'index'])->middleware('checksession');
Route::get('/deposit', [TransactionController::class, 'show_deposit'])->name('deposit')->middleware('checksession');
Route::post('/deposit', [TransactionController::class, 'save_deposit'])->name('deposit')->middleware('checksession');
Route::get('/withdrawal', [TransactionController::class, 'show_withdrawal'])->name('withdrawal')->middleware('checksession');
Route::post('/withdrawal', [TransactionController::class, 'save_withdrawal'])->name('withdrawal')->middleware('checksession');

Route::get('/users', [UserController::class, 'index']);
Route::post('/usersCreate', [UserController::class, 'create'])->name('users_create');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/sing_in', [UserController::class, 'sing_in'])->name('sing_in');

