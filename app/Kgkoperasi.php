<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kgkoperasi extends Model
{
    use HasFactory;
    protected $table = 'tb_kgkoperasi';
    protected $fillable = [
        'kegiatan',
        'start_date',
        'end_date',
        'pelaksana',
        'jumlah',
        'keterangan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
