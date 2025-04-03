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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('feedback_id'); // Primaire sleutel
            $table->unsignedBigInteger('reservering_id'); // Foreign key
            $table->text('commentaar');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('reservering_id')
                ->references('reservering_id')
                ->on('reserveringen')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
