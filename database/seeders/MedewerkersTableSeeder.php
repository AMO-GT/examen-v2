<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medewerker;
use App\Models\Eigenaar;

class MedewerkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Maak eerst een eigenaar aan
        $eigenaar = Eigenaar::create([
            'naam' => 'Test Eigenaar',
            'email' => 'eigenaar@hairhub.nl',
            'password' => bcrypt('password'),
            'bedrijfsnaam' => 'HairHub',
            'adres' => 'Teststraat 1',
            'postcode' => '1234 AB',
            'plaats' => 'Amsterdam',
            'telefoon' => '0612345678'
        ]);

        $medewerkers = [
            [
                'naam' => 'Mo',
                'email' => 'mo@hairhub.nl',
                'eigenaar_id' => $eigenaar->eigenaar_id
            ],
            [
                'naam' => 'Badr',
                'email' => 'badr@hairhub.nl',
                'eigenaar_id' => $eigenaar->eigenaar_id
            ],
            [
                'naam' => 'Ahmad',
                'email' => 'ahmad@hairhub.nl',
                'eigenaar_id' => $eigenaar->eigenaar_id
            ],
            [
                'naam' => 'Jan',
                'email' => 'jan@hairhub.nl',
                'eigenaar_id' => $eigenaar->eigenaar_id
            ]
        ];

        foreach ($medewerkers as $medewerker) {
            Medewerker::create($medewerker);
        }
    }
}
