<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listPeserta extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'list_peserta';

    protected $fillable = [
        'id',
        'nama',
        'list_rapat_id',
    ];

    public function list_rapat() {
        return $this->belongsTo('App\Models\ListRapat');
    }
}
