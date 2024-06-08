<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'poster',
        'description',
        'genre',
        'duration',
        'year',
        'total_note',
        'total_registered',
        'num_favorite',
        'ip_api',
    ];

    public function valuations()
    {
        return $this->hasMany(Valuation::class);
    }

    public function actors()
    {
        return $this->hasMany(Actor::class);
    }
}
