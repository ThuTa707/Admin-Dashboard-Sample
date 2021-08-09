<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth', 'BanUser' ])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    // Admin
    Route::middleware('AdminOnly')->group(function () {
        Route::get('admin/show/user-list', [UserController::class, 'index'])->name('admin.show.user');
        Route::post('admin/{id}/make-admin', [UserController::class, 'makeAdmin'])->name('admin.makeAdmin.user');
        Route::post('admin/{id}/ban-user', [UserController::class, 'banUser'])->name('admin.ban.user');
        Route::post('admin/{id}/unban-user', [UserController::class, 'unbanUser'])->name('admin.unban.user');
        Route::post('admin/change-new-password', [UserController::class, 'changenewPassword'])->name('admin.change.newPassword');


        // PW Change with Ajax Sweet Alert
        Route::post('admin/change-password', [UserController::class, 'changePassword'])->name('admin.changePassword.user');


    });

    // Profile
    Route::prefix('user-profile')->group(function () {
        Route::get('/', 'ProfileController@profile')->name('profile');
        Route::get('/edit/photo', 'ProfileController@editPhoto')->name('profile.edit.photo');
        Route::post('/change/photo', 'ProfileController@changePhoto')->name('profile.change.photo');
        Route::get('/edit/name-email', 'ProfileController@editNameEmail')->name('profile.edit.name-email');
        Route::post('/change/name-email', 'ProfileController@changeNameEmail')->name('profile.change.name-email');
        Route::get('/edit/password', 'ProfileController@editPassword')->name('profile.edit.password');
        Route::post('/change/password', 'ProfileController@changePassword')->name('profile.change.password');
        Route::post('/change/phone-address', 'ProfileController@updatePhoneAddress')->name('profile.change.phone-address');
    });
});
