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
        Schema::create('sys_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model', 200);
            $table->enum('action', ['Create', 'Delete', 'Update', 'Zap']);
            $table->mediumText('data')->nullable();
            $table->mediumText('rawdata')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->smallInteger('user_create')->nullable()->default(0);
            $table->dateTime('updated_at')->nullable();
            $table->smallInteger('user_update')->nullable()->default(0);
            $table->dateTime('deleted_at')->nullable();
            $table->smallInteger('user_delete')->nullable()->default(0);
            $table->index('model');
            $table->index('action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_logs');
    }
};
