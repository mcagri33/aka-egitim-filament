<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request, $code)
    {
        $language = Language::where('code', $code)
            ->where('is_active', true)
            ->first();

        if ($language) {
            Session::put('locale', $code);
            app()->setLocale($code);
        }

        return redirect()->back();
    }
}
