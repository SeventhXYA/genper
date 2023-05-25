<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{
    use HasFactory;
    protected $table = 'tb_interval';
    protected $fillable = [
        'interval_bp',

        'interval_sd',

        'interval_ic',

        'interval_kl',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
