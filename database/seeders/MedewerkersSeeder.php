<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eigenaar;
use App\Models\Medewerker;
use App\Models\Tijdsblok;

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

        // Medewerker 1 - Werkt alleen op maandag, woensdag en vrijdag
        $medewerker1 = Medewerker::create([
            'eigenaar_id' => $eigenaar->eigenaar_id,
            'naam' => 'Janneke Jansen',
            'email' => 'janneke@voorbeeld.com',
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