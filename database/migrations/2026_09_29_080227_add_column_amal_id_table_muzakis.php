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
        Schema::table('muzakis', function (Blueprint $table) {
            $table->foreignId('amal_id')->nullable()->after('id')->constrained('jenis_amals')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muzakis', function (Blueprint $table) {
            $table->dropForeign(['amal_id']);
            $table->dropColumn('amal_id');
        });
    }
};
