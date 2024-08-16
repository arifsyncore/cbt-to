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
        Schema::create('m_nilai_jawabans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_soal')->nullable();
            $table->string('opsi', 100)->nullable();
            $table->decimal('nilai', 10, 2)->nullable();
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
        Schema::dropIfExists('m_nilai_jawabans');
    }
};
