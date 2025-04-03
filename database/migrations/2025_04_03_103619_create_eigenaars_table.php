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
        Schema::create('eigenaars', function (Blueprint $table) {
            $table->id('eigenaar_id'); // Primaire sleutel
            $table->string('naam', 100);
            $table->string('email', 100);
            $table->timestamps(); // Optioneel: voor created_at en updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eigenaars');
    }
};
