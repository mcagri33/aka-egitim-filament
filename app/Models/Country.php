<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function offices()
    {
        return $this->hasManyThrough(
            Office::class, 
            City::class,
            'country_id', // Foreign key on cities table
            'city_id',   // Foreign key on offices table
            'id',        // Local key on countries table
            'id'         // Local key on cities table
        );
    }
}
