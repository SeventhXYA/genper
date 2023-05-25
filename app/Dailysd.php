<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailysd extends Model
{
    use HasFactory;
    protected $table = 'tb_dailysd';
    protected $fillable = [
        'tgl_sd',
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
