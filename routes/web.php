<?php

use App\Livewire\CreatePost;
use App\Livewire\Formulario;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Route::get('/dashboard', Formulario::class)->name('dashboard')->lazy();//componente de página completa con lazy load - no tienes que agregar el componente
    // Route::get('/dashboard', CreatePost::class)->name('dashboard');
    Route::view('/prueba', 'prueba')->name('prueba');
});
