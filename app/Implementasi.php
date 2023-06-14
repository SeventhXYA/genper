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
        'start_date',
        'end_date',
        'pelaksana',
        'jumlah',
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
