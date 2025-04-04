<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eigenaar;
use App\Models\Medewerker;
use App\Models\Tijdsblok;
use App\Models\Behandeling;

class MedewerkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Maak eerst een eigenaar als die nog niet bestaat
        $eigenaar = Eigenaar::firstOrCreate(
            ['email' => 'eigenaar@voorbeeld.com'],
            ['naam' => 'Hoofdeigenaar']
        );

        // Maak eerst wat standaard behandelingen aan als ze nog niet bestaan
        $behandelingen = [
            ['naam' => 'Knippen', 'duur' => 30, 'prijs' => 29.50],
            ['naam' => 'Wassen & knippen', 'duur' => 45, 'prijs' => 35.00],
            ['naam' => 'Kleuren', 'duur' => 60, 'prijs' => 65.00],
            ['naam' => 'Highlights', 'duur' => 90, 'prijs' => 75.00],
            ['naam' => 'Föhnen & Stylen', 'duur' => 30, 'prijs' => 25.00],
            ['naam' => 'Permanente wave', 'duur' => 120, 'prijs' => 80.00],
            ['naam' => 'Bruidskapsels', 'duur' => 90, 'prijs' => 120.00],
            ['naam' => 'Kinderen knippen (t/m 12 jaar)', 'duur' => 30, 'prijs' => 19.50],
        ];

        $behandelingModels = [];
        foreach ($behandelingen as $behandeling) {
            $model = Behandeling::firstOrCreate(
                ['naam' => $behandeling['naam']],
                [
                    'duur' => $behandeling['duur'],
                    'prijs' => $behandeling['prijs']
                ]
            );
            $behandelingModels[] = $model;
        }

        // Medewerker 1 - Werkt alleen op maandag, woensdag en vrijdag
        $medewerker1 = Medewerker::create([
            'eigenaar_id' => $eigenaar->eigenaar_id,
            'naam' => 'Janneke Jansen',
            'email' => 'janneke@voorbeeld.com',
        ]);

        // Voeg behandelingen toe aan medewerker 1
        $medewerker1->behandelingen()->attach([
            $behandelingModels[0]->behandeling_id, // Knippen
            $behandelingModels[1]->behandeling_id, // Wassen & knippen
            $behandelingModels[2]->behandeling_id, // Kleuren
        ]);

        // Tijdsblokken voor medewerker 1
        // Maandag
        Tijdsblok::create([
            'medewerker_id' => $medewerker1->medewerker_id,
            'day_of_week' => 1,
            'starttijd' => '09:00:00',
            'eindtijd' => '17:00:00',
        ]);

        // Woensdag
        Tijdsblok::create([
            'medewerker_id' => $medewerker1->medewerker_id,
            'day_of_week' => 3,
            'starttijd' => '09:00:00',
            'eindtijd' => '17:00:00',
        ]);

        // Vrijdag
        Tijdsblok::create([
            'medewerker_id' => $medewerker1->medewerker_id,
            'day_of_week' => 5,
            'starttijd' => '09:00:00',
            'eindtijd' => '17:00:00',
        ]);

        // Medewerker 2 - Werkt alleen op dinsdag en donderdag
        $medewerker2 = Medewerker::create([
            'eigenaar_id' => $eigenaar->eigenaar_id,
            'naam' => 'Pieter de Vries',
            'email' => 'pieter@voorbeeld.com',
        ]);

        // Voeg behandelingen toe aan medewerker 2
        $medewerker2->behandelingen()->attach([
            $behandelingModels[0]->behandeling_id, // Knippen
            $behandelingModels[4]->behandeling_id, // Föhnen & Stylen
            $behandelingModels[3]->behandeling_id, // Highlights
        ]);

        // Tijdsblokken voor medewerker 2
        // Dinsdag
        Tijdsblok::create([
            'medewerker_id' => $medewerker2->medewerker_id,
            'day_of_week' => 2,
            'starttijd' => '09:00:00',
            'eindtijd' => '17:00:00',
        ]);

        // Donderdag
        Tijdsblok::create([
            'medewerker_id' => $medewerker2->medewerker_id,
            'day_of_week' => 4,
            'starttijd' => '09:00:00',
            'eindtijd' => '17:00:00',
        ]);

        // Medewerker 3 - Werkt op alle weekdagen
        $medewerker3 = Medewerker::create([
            'eigenaar_id' => $eigenaar->eigenaar_id,
            'naam' => 'Mohammed El Amrani',
            'email' => 'mohammed@voorbeeld.com',
        ]);

        // Voeg behandelingen toe aan medewerker 3 (alle behandelingen)
        $behandelingIds = array_map(function($model) {
            return $model->behandeling_id;
        }, $behandelingModels);
        $medewerker3->behandelingen()->attach($behandelingIds);

        // Tijdsblokken voor medewerker 3 (maandag t/m vrijdag)
        for ($day = 1; $day <= 5; $day++) {
            Tijdsblok::create([
                'medewerker_id' => $medewerker3->medewerker_id,
                'day_of_week' => $day,
                'starttijd' => '09:00:00',
                'eindtijd' => '17:00:00',
            ]);
        }

        // Medewerker 4 - Werkt alleen in het weekend (zaterdag en zondag)
        $medewerker4 = Medewerker::create([
            'eigenaar_id' => $eigenaar->eigenaar_id,
            'naam' => 'Fatima Bakker',
            'email' => 'fatima@voorbeeld.com',
        ]);

        // Voeg behandelingen toe aan medewerker 4
        $medewerker4->behandelingen()->attach([
            $behandelingModels[6]->behandeling_id, // Bruidskapsels
            $behandelingModels[5]->behandeling_id, // Permanente wave
            $behandelingModels[3]->behandeling_id, // Highlights
            $behandelingModels[7]->behandeling_id, // Kinderen knippen
        ]);

        // Tijdsblokken voor medewerker 4
        // Zaterdag
        Tijdsblok::create([
            'medewerker_id' => $medewerker4->medewerker_id,
            'day_of_week' => 6,
            'starttijd' => '10:00:00',
            'eindtijd' => '18:00:00',
        ]);

        // Zondag
        Tijdsblok::create([
            'medewerker_id' => $medewerker4->medewerker_id,
            'day_of_week' => 0,
            'starttijd' => '12:00:00',
            'eindtijd' => '16:00:00',
        ]);
    }
} 