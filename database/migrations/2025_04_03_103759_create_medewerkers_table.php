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
        Schema::create('medewerkers', function (Blueprint $table) {
            $table->id('medewerker_id'); // Primaire sleutel
            $table->unsignedBigInteger('eigenaar_id'); // Foreign key
            $table->string('naam', 100);
            $table->string('email', 100);
            $table->timestamps();
    
            // Foreign key constraint
            $table->foreign('eigenaar_id')
                  ->references('eigenaar_id')
                  ->on('eigenaars')
                  ->onDelete('cascade'); // Optioneel: verwijder gekoppelde medewerkers als eigenaar wordt verwijderd
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medewerkers');
    }
};
