<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherAlert extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'city',
        'threshold_precipitation',
        'threshold_uv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
