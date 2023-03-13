<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

//Route::get('/', function () {
//
////    $user = User::query()->create([
////        'username' => 'username' . uniqid(),
////        'email' => uniqid() . '@gmail.com',
////        'password' => Hash::make('fqhfn2003')
////    ]);
//
////    User::query()->find(3)->update([
////        'username' => 'new user'
////    ]);
//
////    dd();
//
//    return view('home');
//});

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/signUp', 'signUp')->name('signUp');
    Route::get('/signIn', 'signIn')->name('signIn');
});

Route::controller(AuthController::class)->prefix('/auth')->as('auth.')->group(function () {
    Route::post('/signUp', 'signUp')->name('signUp');

    Route::post('/signIn', 'signIn')->name('signIn');

    Route::get('/logOut', 'logOut')->name('logOut');
});

Route::controller(ArticleController::class)->prefix('/articles')->as('article.')->group(function () {

    Route::middleware(['auth', AdminMiddleware::class])->group(function () {

        Route::get('/create', 'createForm')->name('createForm');
        Route::get('/{article:id}/update', 'updateForm')->name('updateForm');

        Route::post('/create', 'store')->name('create');

       Route::get('/{article:id}/delete', 'delete')->name('delete');

       Route::post('/{article:id}/update', 'update')->name('update');
    });

   Route::get('/{article:id}', 'single')->name('single');
});
