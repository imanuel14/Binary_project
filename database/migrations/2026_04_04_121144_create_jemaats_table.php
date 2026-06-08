<?php
// database/migrations/2024_01_01_000000_create_jemaats_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jemaats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_induk')->unique()->nullable(); // Nomor Induk Jemaat
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']); // L = Laki-laki, P = Perempuan
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->string('status_perkawinan')->nullable(); // Belum Menikah, Menikah, Duda/Janda
            $table->date('tanggal_perkawinan')->nullable();
            $table->string('nama_pasangan')->nullable();
            
            // Data Baptis
            $table->boolean('sudah_baptis')->default(false);
            $table->date('tanggal_baptis')->nullable();
            $table->string('tempat_baptis')->nullable();
            $table->string('pendeta_baptis')->nullable();
            
            // // Data Sidi
            // $table->boolean('sudah_sidi')->default(false);
            // $table->date('tanggal_sidi')->nullable();
            // $table->string('tempat_sidi')->nullable();
            
            // Data Pekerjaan & Pendidikan
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nama_tempat_kerja')->nullable();
            
            // Data Keluarga
            $table->foreignId('keluarga_id')->nullable()->constrained('jemaats')->onDelete('set null'); // Untuk relasi kepala keluarga
            $table->string('hubungan_keluarga')->nullable(); // Kepala Keluarga, Istri, Anak, dll
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            
            // Data Gereja
            $table->date('tanggal_bergabung')->nullable();
            $table->enum('status_jemaat', ['aktif', 'tidak_aktif', 'pindah', 'meninggal'])->default('aktif');
            $table->text('keterangan')->nullable();
            
            $table->string('foto')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null'); // Admin yang input
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jemaats');
    }
};