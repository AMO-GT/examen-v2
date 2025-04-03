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
        Schema::create('reservering_behandeling', function (Blueprint $table) {
            $table->unsignedBigInteger('reservering_id');
            $table->unsignedBigInteger('behandeling_id');
    
            // Samengestelde primaire sleutel
            $table->primary(['reservering_id', 'behandeling_id']);
    
            // Foreign keys
            $table->foreign('reservering_id')
                  ->references('reservering_id')
                  ->on('reserveringen')
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
        Schema::dropIfExists('reservering_behandeling');
    }
};
