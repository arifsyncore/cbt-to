<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TSesiUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_sesi_users';
    protected $guarded = ['id'];
}
