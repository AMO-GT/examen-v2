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
        Schema::table('reserveringen', function (Blueprint $table) {
            $table->text('opmerkingen')->nullable()->after('tijd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserveringen', function (Blueprint $table) {
            $table->dropColumn('opmerkingen');
        });
    }
};
