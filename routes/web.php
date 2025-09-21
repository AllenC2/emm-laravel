<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('sacerdotes', App\Http\Controllers\SacerdoteController::class);
Route::resource('comunidades', App\Http\Controllers\ComunidadeController::class);
Route::resource('matrimonios', App\Http\Controllers\MatrimonioController::class);
Route::resource('coordinaciones', App\Http\Controllers\CoordinacioneController::class);
Route::resource('experiencias', App\Http\Controllers\ExperienciaController::class);
Route::resource('experiencia_matrimonio', App\Http\Controllers\ExperienciaMatrimonioController::class);