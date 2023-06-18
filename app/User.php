<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_user';
    protected $fillable = ['foto', 'nm_depan', 'nm_belakang', 'jk', 'tmp_lahir', 'tgl_lahir', 'nohp', 'email', 'alamat', 'id_divisi', 'username', 'password', 'id_level'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function getNameAttribute()
    {
        return $this->nm_depan . ' ' . $this->nm_belakang;
    }

    public function password_reset()
    {
        return $this->hasOne(PasswordReset::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

    public function evaluate()
    {
        return $this->hasMany(Evaluate::class)->latest();
    }

    public function implementasi()
    {
        return $this->hasMany(Implementasi::class)->latest();
    }

    public function kgkoperasi()
    {
        return $this->hasMany(Kgkoperasi::class)->latest();
    }

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class)->latest();
    }

    public function dailysd()
    {
        return $this->hasMany(Dailysd::class)->latest();
    }

    public function dailybp()
    {
        return $this->hasMany(Dailybp::class)->latest();
    }
    public function dailykl()
    {
        return $this->hasMany(Dailykl::class)->latest();
    }
    public function dailyic()
    {
        return $this->hasMany(Dailyic::class)->latest();
    }

    public function weekly()
    {
        return $this->hasMany(Weekly::class)->latest();
    }

    public function interval()
    {
        return $this->hasMany(Interval::class)->latest();
    }

    public function totalBpDate($date)
    {
        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();

        $interval = Interval::where('user_id', '=', $this->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()->first();

        if (is_null($interval)) return 0;

        $bp = $interval->interval_bp;

        return $bp;
    }

    public function totalSdDate($date)
    {
        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();

        $interval = Interval::where('user_id', '=', $this->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()->first();

        if (is_null($interval)) return 0;

        $sd = $interval->interval_sd;

        return $sd;
    }

    public function getTotalSdAttribute()
    {
        return $this->totalSdDate(Carbon::today());
    }

    public function getPercentageSdAttribute()
    {
        $a = $this->totalSd;
        $b = ($a / 3600) * 100;
        return $b;
    }

    public function totalKlDate($date)
    {
        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();

        $interval = Interval::where('user_id', '=', $this->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()->first();

        if (is_null($interval)) return 0;

        $kl = $interval->interval_kl;

        return $kl;
    }

    public function totalIcDate($date)
    {
        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();

        $interval = Interval::where('user_id', '=', $this->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()->first();

        if (is_null($interval)) return 0;

        $ic = $interval->interval_ic;

        return $ic;
    }

    public function getTotalBpAttribute()
    {
        return $this->totalBpDate(Carbon::today());
    }

    public function getPercentageBpAttribute()
    {
        $a = $this->totalBp;
        $b = ($a / 14400) * 100;
        return $b;
    }


    public function getTotalKlAttribute()
    {
        return $this->totalKlDate(Carbon::today());
    }

    public function getPercentageKlAttribute()
    {
        $a = $this->totalKl;
        $b = ($a / 1800) * 100;
        return $b;
    }

    public function getTotalIcAttribute()
    {
        return $this->totalIcDate(Carbon::today());
    }

    public function getPercentageIcAttribute()
    {
        $a = $this->totalIc;
        $b = ($a / 1800) * 100;
        return $b;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
