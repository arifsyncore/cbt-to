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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('name');
            $table->string('nama_alias')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Wanita'])->nullable();
            $table->string('no_telp')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota_kab')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['aktif', 'non aktif'])->default('aktif')->nullable();
            $table->rememberToken();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
