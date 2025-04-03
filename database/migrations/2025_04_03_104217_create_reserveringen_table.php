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
        Schema::create('reserveringen', function (Blueprint $table) {
            $table->id('reservering_id'); // Primaire sleutel
            $table->unsignedBigInteger('klant_id');
            $table->unsignedBigInteger('medewerker_id');
            $table->date('datum');
            $table->time('tijd');
            $table->timestamps();

            // Foreign keys
            $table->foreign('klant_id')
                ->references('klant_id')
                ->on('klanten')
                ->onDelete('cascade');

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
        Schema::dropIfExists('reserveringen');
    }
};
