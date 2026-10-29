<?php

use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\ContactMessageController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProjectController;
use App\Http\Controllers\Site\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/servicos', [ServiceController::class, 'index'])->name('services.index');
Route::get('/servicos/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/projetos', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projetos/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/sobre', AboutController::class)->name('about');

Route::get('/contato', [ContactMessageController::class, 'create'])->name('contact.create');
Route::post('/contato', [ContactMessageController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('contact.store');
