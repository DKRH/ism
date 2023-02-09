<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fork extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'data_fork';

    protected $fillable = [
        'id',
        'nama',
    ];
}
