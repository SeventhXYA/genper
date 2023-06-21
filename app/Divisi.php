<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'tb_divisi';
    protected $fillable = [
        'divisi',
        'akundivisi_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function akundivisi()
    {
        return $this->belongsTo(Akundivisi::class);
    }

    public function weekly()
    {
        return $this->hasMany(Weekly::class);
    }
}
