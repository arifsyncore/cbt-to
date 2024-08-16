<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MNilaiJawaban extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_nilai_jawabans';
    protected $guarded = ['id'];
}
