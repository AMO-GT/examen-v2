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
        Schema::create('medewerker_product', function (Blueprint $table) {
            $table->unsignedBigInteger('medewerker_id');
            $table->unsignedBigInteger('product_id');

            // Samengestelde primaire sleutel
            $table->primary(['medewerker_id', 'product_id']);

            // Foreign keys
            $table->foreign('medewerker_id')
                ->references('medewerker_id')
                ->on('medewerkers')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('product_id')
                ->on('producten')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medewerker_product');
    }
};
