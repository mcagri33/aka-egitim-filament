<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'is_default',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function pageTranslations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function postTranslations()
    {
        return $this->hasMany(PostTranslation::class);
    }

    public function bannerTranslations()
    {
        return $this->hasMany(BannerTranslation::class);
    }

    public function menuItemTranslations()
    {
        return $this->hasMany(MenuItemTranslation::class);
    }
}
