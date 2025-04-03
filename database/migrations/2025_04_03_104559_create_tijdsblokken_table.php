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
        Schema::create('tijdsblokken', function (Blueprint $table) {
            $table->id('tijdsblok_id'); // Primaire sleutel
            $table->unsignedBigInteger('medewerker_id'); // Foreign key naar medewerker
            $table->time('starttijd');
            $table->time('eindtijd');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('medewerker_id')
                ->references('medewerker_id')
                ->on('medewerkers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tijdsblokken');
    }
};
