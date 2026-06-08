<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');                    // Judul kegiatan
            $table->text('description')->nullable();    // Deskripsi
            $table->string('image');                    // Path foto
            $table->enum('category', ['ibadah', 'pendidikan', 'sosial', 'pemuda', 'lainnya'])->default('lainnya');
            $table->date('event_date')->nullable();     // Tanggal kegiatan
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};