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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['magang', 'penelitian']);
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('nim_nisn')->nullable();
            $table->string('institution')->nullable();
            $table->string('study_program')->nullable();

            // Khusus Pendaftaran Penelitian
            $table->date('start_date')->nullable();
            $table->string('research_title')->nullable();

            // Khusus Pendaftaran Magang
            $table->enum('participant_category', ['Sekolah Menengah Kejuruan', 'Perguruan Tinggi'])->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('address')->nullable();
            $table->json('magang_months')->nullable();
            $table->string('advisor_name')->nullable();
            $table->string('advisor_phone')->nullable();

            // Upload Surat Permohonan
            $table->string('document_path')->nullable();

            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'selesai'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
