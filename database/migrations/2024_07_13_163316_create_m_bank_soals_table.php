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
        Schema::create('m_bank_soals', function (Blueprint $table) {
            $table->id();
            $table->integer('id_jenis')->nullable();
            $table->string('nama_soal')->nullable();
            $table->string('kode', 10)->nullable();
            $table->decimal('jml_soal', 10, 2)->nullable();
            $table->decimal('bobot_soal', 10, 2)->nullable();
            $table->decimal('jml_opsi_jwb')->nullable();
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
        Schema::dropIfExists('m_bank_soals');
    }
};
