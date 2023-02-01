<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerangkatDaerah extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'data_perangkat_daerah';

    protected $fillable = [
        'id',
        'nama',
        'jabatan',
    ];
}
