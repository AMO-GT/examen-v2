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
        Schema::create('klanten', function (Blueprint $table) {
            $table->id('klant_id'); // Primaire sleutel
            $table->string('naam', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('telefoon', 20)->nullable();
            $table->string('adres')->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('plaats', 100)->nullable();
            $table->rememberToken();
            $table->timestamps(); // Voor created_at en updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klanten');
    }
};
