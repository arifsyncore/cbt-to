<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MJenisUjianDet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_jenis_ujian_dets';
    protected $guarded = ['id'];

    public function soal()
    {
        return $this->hasMany(MSoal::class, 'id_jenis_det', 'id', 'id');
    }
}
