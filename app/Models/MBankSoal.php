<?php

namespace App\Models;

use App\Models\admin\MJenisUjian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MBankSoal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_bank_soals';
    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo(MJenisUjian::class, 'id_jenis', 'id', 'id');
    }
}
