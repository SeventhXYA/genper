<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailykl extends Model
{
    use HasFactory;
    protected $table = 'tb_dailykl';
    protected $fillable = [
        'tgl_kl',
        'wkt_mulai',
        'wkt_selesai',
        'rencana',
        'aktual',
        'progres',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
