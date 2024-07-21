<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MJenis extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_jenis';
    protected $guarded = ['id'];
}
