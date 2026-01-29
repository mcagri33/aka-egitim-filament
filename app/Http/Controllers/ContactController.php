<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Filament\Notifications\Notification;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'program_type' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Veritabanına kayıt
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'program_type' => $request->program_type,
            'language' => $request->language,
            'message' => $request->message,
            'is_read' => false,
        ]);

        // Email gönderimi
        try {
            $adminEmail = \App\Models\Setting::where('key', 'contact_email')->first()?->value 
                ?? config('mail.from.address');
            
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new ContactFormSubmitted($contact));
            }
        } catch (\Exception $e) {
            // Email gönderiminde hata olsa bile form kaydı başarılı
            \Log::error('Contact form email error: ' . $e->getMessage());
        }

        // Filament notification (tüm kullanıcılara gönder - admin panelinde görünecek)
        try {
            $users = \App\Models\User::all();
            
            foreach ($users as $user) {
                try {
                    if (method_exists($user, 'can') && $user->can('viewAny', Contact::class)) {
                        Notification::make()
                            ->title('Yeni İletişim Formu')
                            ->body($contact->name . ' adlı kullanıcıdan yeni bir iletişim formu gönderildi.')
                            ->success()
                            ->sendToDatabase($user);
                    }
                } catch (\Exception $e) {
                    // Tek bir kullanıcıya gönderim hatası diğerlerini etkilemesin
                    continue;
                }
            }
        } catch (\Exception $e) {
            // Notification hatası form kaydını etkilemesin
            \Log::error('Contact form notification error: ' . $e->getMessage());
        }
        
        return back()->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
    }
}
