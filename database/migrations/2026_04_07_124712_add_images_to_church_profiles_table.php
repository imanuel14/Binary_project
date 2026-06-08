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
        Schema::table('church_profiles', function (Blueprint $table) {
            // Menambah kolom baru
            $table->string('church_image')->nullable()->after('history');
            $table->string('pastor_image')->nullable()->after('church_image');
        });
    }

    public function down(): void
    {
        Schema::table('church_profiles', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn(['church_image', 'pastor_image']);
        });
    }
};
