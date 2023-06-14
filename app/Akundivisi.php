<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Akundivisi extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_akundivisi';
    protected $fillable = ['id_divisi', 'username', 'password', 'id_level'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

    public function weekly()
    {
        return $this->hasMany(Weekly::class);
    }
}
