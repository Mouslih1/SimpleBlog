<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Models\Post;
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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.do');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login/inscrire',[AuthController::class, 'inscrire'])->name('inscrire');
Route::post('/login/inscrire',[AuthController::class, 'doInscrire']);
Route::prefix('/blog')->middleware(['auth'])->name('blog.')->group(function(){

    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}-{post}', [BlogController::class, 'show'])->where(['post' => '[0-9]+' , 'slug' => '[a-z0-9\-]+'])->name('show');
    Route::get('/new', [BlogController::class, 'create'])->name('create');
    Route::post('/new',[BlogController::class, 'store'])->name('store');
    Route::get('/{post}/edit', [BlogController::class, 'edit'])->name('edit');
    Route::patch('/{post}/edit', [BlogController::class, 'update'])->name('update');

});
