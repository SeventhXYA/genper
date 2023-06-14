<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Implementasi extends Model
{
    use HasFactory;
    protected $table = 'tb_implementasi';
    protected $fillable = [
        'program',
        'tgl_pelaksanaan',
        'pelaksana',
        'jmlh',
        'penerima_manfaat',
        'rab',
        'realisasi',
        'keterangan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
