<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SysLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sys_logs';
    protected $guarded = ['id'];
}
