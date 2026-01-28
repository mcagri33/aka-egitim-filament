<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_id',
        'language_id',
        'title',
        'description',
        'button_text',
        'button_url',
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
