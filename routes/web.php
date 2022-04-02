<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('inscription', \App\Http\Livewire\Inscription::class)->name('inscription');
});


Route::get('/authentification', \App\Http\Livewire\Auth\Authentification::class)->name('authentification')->middleware('guest');
