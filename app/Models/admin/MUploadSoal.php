<?php

namespace App\Models\admin;

use App\Models\MBankSoal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MUploadSoal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_upload_soals';
    protected $guarded = ['id'];

    public function soal()
    {
        return $this->belongsTo(MBankSoal::class, 'id_bank_soal', 'id', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo(MJenis::class, 'id_jenis', 'id', 'id');
    }
}
