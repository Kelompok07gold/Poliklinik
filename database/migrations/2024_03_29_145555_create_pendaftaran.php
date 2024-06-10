<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien');
            $table->string('no_antrian');
            $table->enum('status', ['Terdaftar', 'Selesai'])->default('Terdaftar');
            $table->enum('pembayaran', ['BPJS', 'Umum']);
            $table->bigInteger('no_bpjs')->nullable();
            $table->date('tanggal_pendaftaran');
            $table->text('diagnosa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
