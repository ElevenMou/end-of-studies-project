<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('etudiants', \App\Http\Livewire\Inscription::class)->name('etudiants');
    Route::get('profil/{id}', \App\Http\Livewire\Profile\IndexProfile::class)->name('profile');
    Route::get('invitations', \App\Http\Livewire\Users\Invitaions::class)->name('invitations');
});


Route::get('/authentification', \App\Http\Livewire\Auth\Authentification::class)->name('authentification')->middleware('guest');
