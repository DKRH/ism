<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelasiRapat extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'relasi_rapat';

    protected $fillable = [
        'id',
        'rapat_id',
        'umum_id',
        'perangkat_daerah_id',
        'anggota_dprd_id',
    ];
}
