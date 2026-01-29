<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/iletisim', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/lang/{code}', [LanguageController::class, 'switch'])->name('language.switch');
