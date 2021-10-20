<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    MemberController,
    BookController
};



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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/member',[MemberController::class, 'index']);
Route::post('/member/post',[MemberController::class, 'post']);
Route::get('/member/edit/{id}',[MemberController::class, 'edit']);
Route::post('member/update/{id}',[MemberController::class, 'update']);
Route::post('member/delete/{id}',[MemberController::class, 'delete']);

Route::resource('book', BookController::class);
Route::get('book/pending/{id}', [BookController::class, 'pending'])->name('pending');
Route::get('book/returned/{id}', [BookController::class, 'returned'])->name('returned');

