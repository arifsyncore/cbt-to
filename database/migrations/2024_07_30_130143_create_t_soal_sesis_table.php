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
        Schema::create('t_soal_sesis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sesi')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_ruang_ujian')->nullable();
            $table->integer('id_soal')->nullable();
            $table->string('no')->nullable();
            $table->string('jawaban', 50)->nullable();
            $table->string('status', 50)->nullable();
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
        Schema::dropIfExists('t_soal_sesis');
    }
};
