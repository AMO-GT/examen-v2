<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tijdsblok;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TijdsblokkenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tijdsblokken')->insert([
            [
                'medewerker_id' => 1,
                'datum' => Carbon::today()->format('Y-m-d'),
                'starttijd' => '08:00:00',
                'eindtijd' => '12:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'medewerker_id' => 1,
                'datum' => Carbon::today()->addDay()->format('Y-m-d'),
                'starttijd' => '13:00:00',
                'eindtijd' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'medewerker_id' => 2,
                'datum' => Carbon::today()->format('Y-m-d'),
                'starttijd' => '09:00:00',
                'eindtijd' => '15:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
