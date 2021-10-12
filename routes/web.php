<?php

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

Auth::routes();

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});
Route::group(array('before' => 'auth'), function() {
    Route::post('/upload-json', [App\Http\Controllers\FileUploadController::class, 'UploadJsonFile'])->name('upload-json');
    Route::get('/table', [App\Http\Controllers\TableController::class, 'index'])->name('table');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
