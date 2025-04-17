<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterCOntroller;
use App\Http\Controllers\Auth\AuthenticateCOntroller;

Route::middleware(['guest'])->group(function () {

Route::get('/register',[RegisterCOntroller::class,'create'])->name('register');
Route::post('/register',[RegisterCOntroller::class,'store']);
Route::get('/login',[AuthenticateCOntroller::class,'create'])->name('login');
Route::post('/login',[AuthenticateCOntroller::class,'store']);

Route::get('/forgot-password',[AuthenticateCOntroller::class,'reset'])->name('password.request');
Route::post('/forgot-password', [AuthenticateCOntroller::class,'email'])->name('password.email');
Route::get('/reset-password/{token}', [AuthenticateCOntroller::class,'sendreset'])->name('password.reset');
Route::post('/reset-password', [AuthenticateCOntroller::class,'update'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout',[AuthenticateCOntroller::class,'destroy'])->name('logout');
    Route::get('/email/verify', [AuthenticateCOntroller::class,'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',[AuthenticateCOntroller::class,'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification',[AuthenticateCOntroller::class,'send'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('/confirm-password',[AuthenticateCOntroller::class,'confirm'])->name('password.confirm');
    Route::post('/confirm-password', [AuthenticateCOntroller::class,'confirmPassword'])->middleware(['throttle:6,1'])->name('password.send');
});
