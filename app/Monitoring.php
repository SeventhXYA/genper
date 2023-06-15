<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;
    protected $table = 'tb_monitoring';
    protected $fillable = [
        'program',
        'keterangan',
        'output',
        'outcome',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
