<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Session'dan dil ayarını yükle
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            // Varsayılan dili veritabanından al
            $defaultLanguage = \App\Models\Language::where('is_default', true)
                ->where('is_active', true)
                ->first();
            
            if ($defaultLanguage) {
                app()->setLocale($defaultLanguage->code);
                session()->put('locale', $defaultLanguage->code);
            }
        }
    }
}
