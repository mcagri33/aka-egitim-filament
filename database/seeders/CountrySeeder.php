<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'code' => 'TR',
                'is_active' => true,
            ],
            [
                'code' => 'KZ',
                'is_active' => true,
            ],
            [
                'code' => 'GB',
                'is_active' => true,
            ],
            [
                'code' => 'FI',
                'is_active' => true,
            ],
            [
                'code' => 'DE',
                'is_active' => true,
            ],
            [
                'code' => 'CA',
                'is_active' => true,
            ],
            [
                'code' => 'US',
                'is_active' => true,
            ],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                ['is_active' => $country['is_active']]
            );
        }
    }
}
