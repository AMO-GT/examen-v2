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
        Schema::create('gewerkte_uren', function (Blueprint $table) {
            $table->unsignedBigInteger('medewerker_id');
            $table->date('datum');
            $table->decimal('uren', 5, 2);
            $table->timestamps();

            // Primaire sleutel (samengesteld)
            $table->primary(['medewerker_id', 'datum']);

            // Foreign key
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
        Schema::dropIfExists('gewerkte_uren');
    }
};
