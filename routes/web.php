<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('profil/{id}', \App\Http\Livewire\Profile\IndexProfile::class)->name('profile');
    Route::get('suivre', \App\Http\Livewire\Users\Follow::class)->name('follow');
    Route::get('recherche', \App\Http\Livewire\Users\Search::class)->name('search');
    /************************************* ADMIN ***************************************/
    Route::get('etudiants', \App\Http\Livewire\Inscription::class)->name('etudiants');
    Route::get('enseignants', \App\Http\Livewire\Enseignants\Index::class)->name('enseignants');
    /************************************* MODERATOR ***************************************/
    Route::get('rapports', \App\Http\Livewire\Moderator\Reports::class)->name('reports');
    /************************************* ELEARNING ***************************************/
    Route::get('elearning', \App\Http\Livewire\Elearning\Elearning::class)->name('elearning');
    Route::get('elearning/module/{id}', \App\Http\Livewire\Elearning\Modules\Show::class)->name('module.show');
    Route::get('elearning/module/{id}/notes', \App\Http\Livewire\Elearning\Modules\Notes\Remplir::class)->name('notes.remplir');
});

Route::get('post/{id}', \App\Http\Livewire\Posts\ShowPost::class)->name('post');
Route::get('/authentification', \App\Http\Livewire\Auth\Authentification::class)->name('authentification')->middleware('guest');
