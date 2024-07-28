<?php

namespace App\Models\user;

use App\Models\admin\MUploadSoal;
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
}
