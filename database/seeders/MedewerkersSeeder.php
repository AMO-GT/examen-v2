<?php

namespace Database\Seeders;

use App\Models\Medewerker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class MedewerkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medewerker::insert([
            [
                'naam' => 'Jan Jansen',
                'email' => 'jan@example.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'naam' => 'Fatima Bakker',
                'email' => 'fatima@example.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
