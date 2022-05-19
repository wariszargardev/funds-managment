<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\EditorAuthController;
use App\Http\Controllers\editor\EditorController;
use App\Http\Controllers\admin\EditorController as AdminEditorController;
use App\Http\Controllers\editor\FundsController;
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

Route::redirect('/', '/editor/login' );
Route::redirect('/login', '/editor/login' );

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
            Route::post('/profile-update', [AdminController::class, 'updateProfile'])->name('profile.update');
            Route::resource('/editor',AdminEditorController::class);
            Route::get('/editor/{editor}',[AdminEditorController::class,'destroy'])->name('editor.destroy');        });
    });
});


Route::group(['middleware' => ['auth:editor']], function () {
    Route::get('editor', [EditorController::class, 'dashboard'])->name('editor.dashboard');
});

Route::group(['middleware' => ['auth:editor']], function () {
    Route::prefix('editor')->group(function () {
        Route::name('editor.')->group(function () {
            Route::get('/', [EditorController::class, 'dashboard'])->name('dashboard');
            Route::get('/profile', [EditorController::class, 'profile'])->name('profile');
            Route::post('/profile-update', [EditorController::class, 'updateProfile'])->name('profile.update');
            Route::resource('/funds',FundsController::class);
        });
    });
});


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get('/editor/login', [EditorAuthController::class, 'showLoginForm'])->name('editor.login');
Route::post('/editor/login', [EditorAuthController::class, 'login'])->name('editor.login');
Route::post('/editor/logout', [EditorAuthController::class, 'logout'])->name('editor.logout');
