<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/iletisim', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/lang/{code}', [LanguageController::class, 'switch'])->name('language.switch');

// Dil Okulları → PathwayCareers.org yönlendirmesi
Route::redirect('/dil-okullari', 'https://pathwaycareers.org', 302)->name('language-schools');

// Üniversite sayfası
Route::get('/universite', [PageController::class, 'university'])->name('university');

// Öğretmen Hareketliliği sayfası
Route::get('/ogretmen-hareketliligi', [PageController::class, 'teacherMobility'])->name('teacher-mobility');

// İletişim sayfası
Route::get('/iletisim', [PageController::class, 'contact'])->name('contact');

// Pages - slug bazlı dinamik route (en sonda olmalı, diğer route'ları ezecek)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show')->where('slug', '[a-z0-9-]+');
