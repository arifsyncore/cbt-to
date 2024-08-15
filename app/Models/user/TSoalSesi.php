<?php

namespace App\Models\user;

use App\Models\admin\MJenisUjianDet;
use App\Models\admin\MSoal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TSoalSesi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_soal_sesis';
    protected $guarded = ['id'];

    public function sesi()
    {
        return $this->belongsTo(TSesiUser::class, 'id_sesi', 'id', 'id');
    }

    public function soal()
    {
        return $this->belongsTo(MSoal::class, 'id_soal', 'id', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo(MJenisUjianDet::class, 'id_jenis_det', 'id', 'id');
    }
}
