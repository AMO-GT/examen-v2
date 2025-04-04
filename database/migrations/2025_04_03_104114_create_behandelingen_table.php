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
        Schema::create('behandelingen', function (Blueprint $table) {
            $table->id('behandeling_id'); // Primaire sleutel
            $table->string('naam', 100);
            $table->text('beschrijving');
            $table->string('categorie', 50); // Nieuwe kolom voor de categorie
            $table->integer('duur_minuten'); // in minuten
            $table->decimal('prijs', 10, 2);
            $table->boolean('is_actief')->default(true);
            $table->boolean('is_populair')->default(false); // Nieuwe kolom voor populaire behandelingen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('behandelingen');
    }
};
