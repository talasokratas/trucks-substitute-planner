<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trucks = [
            [
                'unit_number' => 'A1578',
                'year' => 2018,
                'notes' => 'Available for rental',
            ],
            [
                'unit_number' => 'B7845',
                'year' => 2020,
                'notes' => 'Under maintenance',
            ],
            [
                'unit_number' => '8050',
                'year' => 2019,
                'notes' => 'Newly acquired truck',
            ],
            [
                'unit_number' => '147859',
                'year' => 2021,
                'notes' => 'Available for long-term rental',
            ],
        ];

        // Insert trucks into the database
        foreach ($trucks as $truck) {
            Truck::create($truck);
        }
    }
}
