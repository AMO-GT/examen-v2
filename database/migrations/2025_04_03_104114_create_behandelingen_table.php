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
            $table->integer('duur'); // in minuten
            $table->decimal('prijs', 10, 2);
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
