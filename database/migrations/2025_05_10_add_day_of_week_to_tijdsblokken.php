<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tijdsblokken', function (Blueprint $table) {
            $table->unsignedTinyInteger('day_of_week')->after('medewerker_id'); // 0=Sunday, 1=Monday, etc.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tijdsblokken', function (Blueprint $table) {
            $table->dropColumn('day_of_week');
        });
    }
}; 