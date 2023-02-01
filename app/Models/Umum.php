<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umum extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'data_umum';

    protected $fillable = [
        'id',
        'nama',
        'status',
        'email',
    ];
}
