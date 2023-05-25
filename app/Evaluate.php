<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    use HasFactory;
    protected $table = 'tb_evaluate';
    protected $fillable = [
        'dailyevaluate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
