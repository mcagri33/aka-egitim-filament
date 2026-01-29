@php
    $currentLocale = session('locale', \App\Models\Language::where('is_default', true)->first()?->code ?? 'kk');
@endphp

<section class="form-section" id="iletisim">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ \App\Models\Setting::get('contact_title_' . $currentLocale, 'Yurt Dışı Eğitim Yolculuğunuza Başlayın') }}</h2>
            <p class="section-description">{{ \App\Models\Setting::get('contact_description_' . $currentLocale, 'Bilgilerinizi bırakın, danışmanımız size en kısa sürede dönüş yapsın.') }}</p>
        </div>
        
        <div class="form-content">
            @if(session('success'))
                <div class="alert alert-success" style="padding: 1rem; background: #d4edda; color: #155724; border-radius: 0.5rem; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="padding: 1rem; background: #f8d7da; color: #721c24; border-radius: 0.5rem; margin-bottom: 1rem;">
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>{{ \App\Models\Setting::get('contact_personal_label_' . $currentLocale, 'Kişisel Bilgiler') }}</label>
                    <div class="form-row">
                        <div>
                            <input type="text" name="name" placeholder="{{ \App\Models\Setting::get('contact_name_placeholder_' . $currentLocale, 'Adınız Soyadınız') }}" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="error-message" style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="{{ \App\Models\Setting::get('contact_email_placeholder_' . $currentLocale, 'E-posta Adresiniz') }}" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="error-message" style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div>
                            <input type="tel" name="phone" placeholder="{{ \App\Models\Setting::get('contact_phone_placeholder_' . $currentLocale, 'Telefon Numaranız') }}" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="error-message" style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input type="date" name="birth_date" placeholder="{{ \App\Models\Setting::get('contact_birth_placeholder_' . $currentLocale, 'Doğum Tarihiniz') }}" value="{{ old('birth_date') }}" required>
                            @error('birth_date')
                                <span class="error-message" style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>{{ \App\Models\Setting::get('contact_education_label_' . $currentLocale, 'Eğitim Tercihleri') }}</label>
                    <div class="form-row">
                        <div>
                            <select name="program_type" required>
                                <option value="">{{ \App\Models\Setting::get('contact_program_placeholder_' . $currentLocale, 'Program Türü Seçiniz') }}</option>
                                <option value="{{ \App\Models\Setting::get('contact_program_dil_' . $currentLocale, 'Dil Eğitimi') }}" {{ old('program_type') == \App\Models\Setting::get('contact_program_dil_' . $currentLocale, 'Dil Eğitimi') ? 'selected' : '' }}>{{ \App\Models\Setting::get('contact_program_dil_' . $currentLocale, 'Dil Eğitimi') }}</option>
                                <option value="{{ \App\Models\Setting::get('contact_program_universite_' . $currentLocale, 'Üniversite') }}" {{ old('program_type') == \App\Models\Setting::get('contact_program_universite_' . $currentLocale, 'Üniversite') ? 'selected' : '' }}>{{ \App\Models\Setting::get('contact_program_universite_' . $currentLocale, 'Üniversite') }}</option>
                                <option value="{{ \App\Models\Setting::get('contact_program_yuksek_' . $currentLocale, 'Yüksek Lisans') }}" {{ old('program_type') == \App\Models\Setting::get('contact_program_yuksek_' . $currentLocale, 'Yüksek Lisans') ? 'selected' : '' }}>{{ \App\Models\Setting::get('contact_program_yuksek_' . $currentLocale, 'Yüksek Lisans') }}</option>
                            </select>
                            @error('program_type')
                                <span class="error-message" style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <select name="language" required>
                                <option value="">{{ \App\Models\Setting::get('contact_language_placeholder_' . $currentLocale, 'Dil Programı Seçiniz') }}</option>
                                <option value="{{ \App\Models\Setting::get('contact_language_ingilizce_' . $currentLocale, 'İngilizce') }}" {{ old('language') == \App\Models\Setting::get('contact_language_ingilizce_' . $currentLocale, 'İngilizce') ? 'selected' : '' }}>{{ \App\Models\Setting::get('contact_language_ingilizce_' . $currentLocale, 'İngilizce') }}</option>
                                <option value="{{ \App\Models\Setting::get('contact_language_almanca_' . $currentLocale, 'Almanca') }}" {{ old('language') == \App\Models\Setting::get('contact_language_almanca_' . $currentLocale, 'Almanca') ? 'selected' : '' }}>{{ \App\Models\Setting::get('contact_language_almanca_' . $currentLocale, 'Almanca') }}</option>
                                <option value="{{ \App\Models\Setting::get('contact_language_fransizca_' . $currentLocale, 'Fransızca') }}" {{ old('language') == \App\Models\Setting::get('contact_language_fransizca_' . $currentLocale, 'Fransızca') ? 'selected' : '' }}>{{ \App\Models\Setting::get('contact_language_fransizca_' . $currentLocale, 'Fransızca') }}</option>
                            </select>
                            @error('language')
                                <span class="error-message" style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>{{ \App\Models\Setting::get('contact_message_label_' . $currentLocale, 'Mesajınız') }}</label>
                    <textarea name="message" rows="4" placeholder="{{ \App\Models\Setting::get('contact_message_placeholder_' . $currentLocale, 'Mesajınızı buraya yazın...') }}">{{ old('message') }}</textarea>
                    @error('message')
                        <span class="error-message" style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary btn-full">{{ \App\Models\Setting::get('contact_button_' . $currentLocale, 'Ücretsiz Danışmanlık Alın') }} →</button>
            </form>
            
            <div class="form-image">
                <div class="form-image-placeholder"></div>
            </div>
        </div>
    </div>
</section>
