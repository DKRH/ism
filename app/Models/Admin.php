<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'data_admin';

    protected $fillable = [
        'id',
        'nip',
        'nama',
        'terakhir_login',
        'password',
    ];
}
