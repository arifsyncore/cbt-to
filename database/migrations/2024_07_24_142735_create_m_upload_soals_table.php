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
        Schema::create('m_upload_soals', function (Blueprint $table) {
            $table->id();
            $table->integer('id_jenis')->nullable();
            $table->integer('id_bank_soal')->nullable();
            $table->enum('type_soal', ['Free', 'Premium'])->default('Free')->nullable();
            $table->dateTime('tanggal_mulai')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->decimal('durasi')->nullable();
            $table->enum('acak_soal', ['1', '0'])->default('0')->nullable();
            $table->enum('acak_opsi', ['1', '0'])->default('0')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->smallInteger('user_create')->nullable()->default(0);
            $table->dateTime('updated_at')->nullable();
            $table->smallInteger('user_update')->nullable()->default(0);
            $table->dateTime('deleted_at')->nullable();
            $table->smallInteger('user_delete')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_upload_soals');
    }
};
