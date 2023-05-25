<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailybp extends Model
{
    use HasFactory;
    protected $table = 'tb_dailybp';
    protected $fillable = [
        'tgl_bp',
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
