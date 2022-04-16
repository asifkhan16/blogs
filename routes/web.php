<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrashController;

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
    return view('home');
});
// Route::view('home','layout.home');
// Route::resource('posts','PostController');

Auth::routes();
Route::resources([
    'posts' => PostController::class,
    'dashboard' => DashboardController::class
]);
Route::get('trash',             [TrashController::class,'get_trash']);
Route::get('trash/delete/{id}', [TrashController::class,'delete_trash']);
Route::get('trash/restore/{id}',[TrashController::class,'restore_trash']);
Route::get('posts/destroy/{id}',[PostController::class,'destroy']);
Route::Post('store',            [PostController::class, 'store']);
Route::get('/home',             [HomeController::class, 'index'])->name('home');
