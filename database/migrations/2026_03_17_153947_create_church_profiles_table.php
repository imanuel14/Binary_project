<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('church_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('church_name');
            $table->text('vision');
            $table->text('mission');
            $table->text('history');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('pastor_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('church_profiles');
    }
};