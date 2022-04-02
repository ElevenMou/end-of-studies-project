<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('inscription',\App\Http\Livewire\Inscription::class)->name('inscription');

});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', \App\Http\Livewire\Auth\Register::class)->name('register');
    Route::get('/login', \App\Http\Livewire\Auth\Login::class)->name('login');
});
