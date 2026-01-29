<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Language;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $currentLocale = session('locale', Language::where('is_default', true)->first()?->code ?? 'kk');
        $language = Language::where('code', $currentLocale)->first();
        $defaultLanguage = Language::where('is_default', true)->first();
        
        if (!$language) {
            $language = $defaultLanguage;
        }
        
        if (!$language) {
            abort(404);
        }

        // Önce mevcut dilde slug'ı ara
        $page = Page::whereHas('translations', function($query) use ($slug, $language) {
            $query->where('slug', $slug)
                  ->where('language_id', $language->id);
        })->where('is_active', true)->first();

        // Bulunamazsa, slug'ı tüm dillerde ara (aynı sayfa, farklı dil)
        if (!$page) {
            $translation = \App\Models\PageTranslation::where('slug', $slug)->first();
            if ($translation) {
                $page = Page::where('id', $translation->page_id)
                    ->where('is_active', true)
                    ->first();
            }
        }

        if (!$page) {
            abort(404);
        }

        // Mevcut dilde translation'ı al
        $translation = $page->translations()->where('language_id', $language->id)->first();
        
        // Mevcut dilde yoksa, varsayılan dilde al
        if (!$translation && $defaultLanguage) {
            $translation = $page->translations()->where('language_id', $defaultLanguage->id)->first();
        }
        
        // Hala yoksa, ilk mevcut translation'ı al
        if (!$translation) {
            $translation = $page->translations()->first();
        }
        
        if (!$translation) {
            abort(404);
        }

        return view('pages.show', [
            'page' => $page,
            'translation' => $translation,
            'currentLocale' => $currentLocale,
        ]);
    }
}
