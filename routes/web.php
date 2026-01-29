<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/iletisim', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/lang/{code}', [LanguageController::class, 'switch'])->name('language.switch');

// Pages - slug bazlı dinamik route (en sonda olmalı, diğer route'ları ezecek)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show')->where('slug', '[a-z0-9-]+');
