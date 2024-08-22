<?php

namespace App\Models\user;

use App\Models\admin\MUploadSoal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TRuangUjian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_ruang_ujians';
    protected $guarded = ['id'];

    public function soalto()
    {
        return $this->belongsTo(MUploadSoal::class, 'id_upload_soal', 'id', 'id');
    }

    public function sesiuser()
    {
        return $this->hasOne(TSesiUser::class, 'id_ruang_ujian', 'id', 'id');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_user', 'id', 'id');
    }

    public function soalsesi()
    {
        return $this->hasMany(TSoalSesi::class, 'id_ruang_ujian', 'id', 'id');
    }
}
