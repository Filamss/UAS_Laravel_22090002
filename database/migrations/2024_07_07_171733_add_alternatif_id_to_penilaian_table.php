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
        Schema::table('penilaian', function (Blueprint $table) {
            $table->unsignedBigInteger('alternatif_id')->after('id');
            
            // Tambahkan foreign key constraint jika perlu
            $table->foreign('alternatif_id')->references('id')->on('alternatif');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {
            $table->dropForeign(['alternatif_id']);
            $table->dropColumn('alternatif_id');
        });
    }
};
