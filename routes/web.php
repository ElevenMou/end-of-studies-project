<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('etudiants', \App\Http\Livewire\Inscription::class)->name('etudiants');
});


Route::get('/authentification', \App\Http\Livewire\Auth\Authentification::class)->name('authentification')->middleware('guest');
