<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\SavingController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    //Login
    Route::get('/', [AuthController::class,'login'])->name('auth.login');
    Route::post('/', [AuthController::class,'loginSubmit'])->name('auth.login.submit');

    //Register
    Route::get('/register', [AuthController::class,'register'])->name('auth.register');
    Route::post('/register', [AuthController::class,'registerSubmit'])->name('auth.register.submit');
});


Route::middleware('check.user')->group(function () {
    //Dashboard
    Route::get('/dashboard', [HomeController::class,'dashboard'])->name('admin.dashboard');

    //Logout
    Route::get('/logout', [HomeController::class,'logout'])->name('auth.logout');

    //Member
    Route::resource('member', MemberController::class);

    //Saving
    Route::resource('saving', SavingController::class);
    Route::get('saving/deposit-withdraw/{member}', [SavingController::class,'depositwithdraw'])->name('saving.depositwithdraw');
    Route::post('saving/deposit-withdraw/{member}', [SavingController::class,'depositwithdrawSubmit'])->name('saving.depositwithdraw.submit');
});
