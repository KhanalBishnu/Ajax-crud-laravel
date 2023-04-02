<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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
    return view('test.index');
});

Route::controller(TestController::class)->group(function(){
    Route::get('/test','index')->name('test');
    Route::get('/test_view','show_test')->name('test.view');
    Route::get('/test/edit/{id}','edit')->name('test.edit');
    Route::post('/test','store')->name('tesk.store');
    Route::put('/test/update/{id}','update')->name('tesk.update');
    Route::delete('/test/delete/{id}','delete')->name('tesk.delete');
    Route::post('/test/test','show')->name('testing');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
