<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listRapat extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'data_rapat';

    protected $fillable = [
        'id',
        'judul_rapat',
        'tanggal_rapat',
        'kuorum_st',
        'deskripsi_rapat',
        'waktu',
        'stat_aktif',
    ];

    public function list_peserta() {
        return $this->hasMany('App\Models\ListPeserta');
    }
}
