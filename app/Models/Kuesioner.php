<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    use HasFactory;

    protected $table = 'kuesioners';

    protected $fillable = [
        'jenis_kelamin',
        'pendidikan',
        'pekerjaan',
        'instansi',
        'jenis_layanan',
        'p1',
        'p2',
        'p3',
        'p4',
        'p5',
        'p6',
        'p7',
        'p8',
        'p9',
        'saran'
    ];
}
