<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AnggotaDPRD as tbl1;
use App\Models\PerangkatDaerah as tbl2;
use App\Models\Umum as tbl3;
use App\Models\Fork as tbl4;

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
        'fork_id',
    ];

    public function getData1($id) {
        return tbl3::where('id',$id)->first();
    }

    public function getData2($id) {
        return tbl2::where('id',$id)->first();
    }

    public function getData3($id) {
        return tbl1::where('id',$id)->first();
    }

    public function getData4($id) {
        return tbl4::where('id',$id)->first();
    }
}
