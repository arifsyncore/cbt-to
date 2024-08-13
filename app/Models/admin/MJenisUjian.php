<?php

namespace App\Models\admin;

use App\Models\MBankSoal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MJenisUjian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_jenis_ujians';
    protected $guarded = ['id'];

    public function detail()
    {
        return $this->hasMany(MJenisUjianDet::class, 'id_jenis', 'id', 'id');
    }

    public function detailSoal()
    {
        return $this->hasMany(MBankSoal::class, 'id_jenis', 'id', 'id');
    }
}
