<?php

namespace App\Models\admin;

use App\Models\MBankSoal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MSoal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_soals';
    protected $guarded = ['id'];

    public function banksoal()
    {
        return $this->belongsTo(MBankSoal::class, 'id_bank_soal', 'id', 'id');
    }

    public function jenissoal()
    {
        return $this->belongsTo(MJenisUjianDet::class, 'id_jenis_det', 'id', 'id');
    }
}
