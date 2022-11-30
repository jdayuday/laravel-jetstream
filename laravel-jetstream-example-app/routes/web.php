<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\DropDownController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('form', [CountryController::class, 'index']);

Route::get('dropdown',[DropDownController::class,'index']);
Route::post('api/fetch-state',[DropDownController::class,'fatchState']);
Route::post('api/fetch-cities',[DropDownController::class,'fatchCity']);