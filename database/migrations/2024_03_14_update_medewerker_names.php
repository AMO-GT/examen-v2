<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Update existing medewerker names
        DB::table('medewerkers')->where('medewerker_id', 1)->update(['naam' => 'Oumnia']);
        DB::table('medewerkers')->where('medewerker_id', 2)->update(['naam' => 'Anna Fleur']);
        DB::table('medewerkers')->where('medewerker_id', 3)->update(['naam' => 'Nazli']);
        // ID 4 (Jan) blijft hetzelfde
    }

    public function down()
    {
        // Restore original names if needed
        DB::table('medewerkers')->where('medewerker_id', 1)->update(['naam' => 'Mo']);
        DB::table('medewerkers')->where('medewerker_id', 2)->update(['naam' => 'Badr']);
        DB::table('medewerkers')->where('medewerker_id', 3)->update(['naam' => 'Ahmad']);
    }
}; 