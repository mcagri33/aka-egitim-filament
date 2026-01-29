<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'program_type',
        'language',
        'message',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_read' => 'boolean',
        ];
    }
}
