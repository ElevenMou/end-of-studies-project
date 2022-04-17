<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('etudiants', \App\Http\Livewire\Inscription::class)->name('etudiants');
    Route::get('enseignants', \App\Http\Livewire\Enseignants\Index::class)->name('enseignants');
    Route::get('profil/{id}', \App\Http\Livewire\Profile\IndexProfile::class)->name('profile');
    Route::get('suivre', \App\Http\Livewire\Users\Follow::class)->name('follow');
    Route::get('recherche', \App\Http\Livewire\Users\Search::class)->name('search');
    Route::get('rapports', \App\Http\Livewire\Moderator\Reports::class)->name('reports');
});

Route::get('post/{id}', \App\Http\Livewire\Posts\ShowPost::class)->name('post');
Route::get('/authentification', \App\Http\Livewire\Auth\Authentification::class)->name('authentification')->middleware('guest');
