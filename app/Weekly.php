<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekly extends Model
{
    use HasFactory;
    protected $table = 'tb_weekly';
    protected $fillable = [
        'id_divisi',
        'start_date',
        'end_date',
        'rencana',
        'status',
        'progres',
    ];

    public function akundivisi()
    {
        return $this->belongsTo(Akundivisi::class, 'id_akundivisi');
    }
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }
}
