<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('etudiants', \App\Http\Livewire\Inscription::class)->name('etudiants');
    Route::get('profil/{id}', \App\Http\Livewire\Profile\IndexProfile::class)->name('profile');
    Route::get('suivre', \App\Http\Livewire\Users\Follow::class)->name('follow');
    Route::get('recherche', \App\Http\Livewire\Users\Search::class)->name('search');
});


Route::get('/authentification', \App\Http\Livewire\Auth\Authentification::class)->name('authentification')->middleware('guest');
