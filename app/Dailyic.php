<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailyic extends Model
{
    use HasFactory;
    protected $table = 'tb_dailyic';
    protected $fillable = [
        'tgl_ic',
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
