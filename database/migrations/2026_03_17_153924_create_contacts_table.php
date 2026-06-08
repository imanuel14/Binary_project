<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('contacts', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama Orang Tua / Pengirim
        $table->string('email')->nullable(); // Dibuat nullable agar form pendaftaran tidak error
        $table->string('phone')->nullable(); // Nomor WhatsApp
        
        // TAMBAHKAN KOLOM INI
        // $table->string('child_name')->nullable(); // Khusus untuk pendaftaran PAUD/Sekolah
        
        $table->text('message')->nullable(); // Pesan umum (opsional)
        
        // Status untuk Dashboard Admin
        $table->enum('status', ['unread', 'read', 'replied'])->default('unread');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};