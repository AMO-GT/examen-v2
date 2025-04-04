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
        Schema::create('producten', function (Blueprint $table) {
            $table->id('product_id'); // Primaire sleutel
            $table->string('naam', 100);
            $table->decimal('prijs', 10, 2);
            $table->text('beschrijving');
            $table->unsignedBigInteger('eigenaar_id'); // Foreign key
            $table->integer('voorraad')->default(0);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('eigenaar_id')
                ->references('eigenaar_id')
                ->on('eigenaars')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producten');
    }
};
