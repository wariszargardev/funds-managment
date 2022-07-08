<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\EditorAuthController;
use App\Http\Controllers\editor\EditorController;
use App\Http\Controllers\admin\EditorController as AdminEditorController;
use App\Http\Controllers\editor\FundsController;
use App\Http\Controllers\admin\FundsController as AdminFundsController;
use App\Http\Controllers\editor\FundsSummaryController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::redirect('/', '/editor/login' );
Route::redirect('/login', '/editor/login' );

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
            Route::post('/profile-update', [AdminController::class, 'updateProfile'])->name('profile.update');
            Route::resource('/editor',AdminEditorController::class);
            Route::get('/editor/{editor}',[AdminEditorController::class,'destroy'])->name('editor.destroy');
            Route::get('/export/{id?}',[AdminFundsController::class,'export'])->name('funds.export');
            Route::resource('/funds',AdminFundsController::class);
            Route::get('/funds-summary', [AdminFundsController::class, 'summary'])->name('funds.summary');
            Route::get('/funds-show-all/{id}', [AdminFundsController::class, 'showAll'])->name('funds.show.all');
        });
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
            Route::get('/editor/funds/{id}/destroy', [FundsController::class, 'destroy'])->name('funds.destroy');
            Route::get('/funds-show-all/{id}', [FundsController::class, 'showAll'])->name('funds.show.all');
            Route::get('/check-phone-number-exists', [FundsController::class, 'checkIsPhoneNumberExists'])->name('funds.check_is_exists_phone_number');

            Route::get('/export/{id?}',[FundsSummaryController::class,'export'])->name('funds.export');
            Route::resource('/fundsdetails',FundsSummaryController::class);
            Route::get('/funds-summary-details', [FundsSummaryController::class, 'summary'])->name('funds.summary');
            Route::get('/funds-show-all-details/{id}', [FundsSummaryController::class, 'showAll'])->name('funds.show.all');
        });
    });
});


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get('/editor/login', [EditorAuthController::class, 'showLoginForm'])->name('editor.login');
Route::post('/editor/login', [EditorAuthController::class, 'login'])->name('editor.login');
Route::post('/editor/logout', [EditorAuthController::class, 'logout'])->name('editor.logout');


// load province city state
Route::get('/', [EditorController::class, 'loadProvinceCity'])->name('loadProvinceCity');
