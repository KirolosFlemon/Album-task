<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotosController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => 'auth'], function (){
    Route::post('album/action',[AlbumController::class,'action'])->name('album.action');
    Route::resource('album',AlbumController::class);
    Route::get('album/{id}/photo',[PhotosController::class,'create'])->name('photos.create');
    Route::post('/photo',[PhotosController::class,'store'])->name('photos.store');
    Route::delete('photo/{id}',[PhotosController::class,'destroy'])->name('photos.destroy');
});


require __DIR__.'/auth.php';
