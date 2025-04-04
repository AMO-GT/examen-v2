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
            $table->id('eigenaar_id');
            $table->string('naam');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('bedrijfsnaam');
            $table->string('adres');
            $table->string('postcode');
            $table->string('plaats');
            $table->string('telefoon');
            $table->timestamps();
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
