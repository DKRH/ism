<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin as tblz;

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
        'jumlah_kursi',
        'admin_id',
        'stat_aktif',
    ];

    public function list_peserta() {
        return $this->hasMany('App\Models\RelasiRapat','rapat_id','id');
    }

    public function admin($id) {
        $d = tblz::where('id',$id)->first();
        return ucfirst($d->nama);
    }
}
