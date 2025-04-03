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
        Schema::create('medewerker_behandeling', function (Blueprint $table) {
            $table->unsignedBigInteger('medewerker_id');
            $table->unsignedBigInteger('behandeling_id');

            // Samengestelde primaire sleutel
            $table->primary(['medewerker_id', 'behandeling_id']);

            // Foreign key constraints
            $table->foreign('medewerker_id')
                ->references('medewerker_id')
                ->on('medewerkers')
                ->onDelete('cascade');

            $table->foreign('behandeling_id')
                ->references('behandeling_id')
                ->on('behandelingen')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medewerker_behandeling');
    }
};
