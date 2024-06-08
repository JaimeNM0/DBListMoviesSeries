<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'poster',
        'description',
        'genre',
        'duration',
        'start_date',
        'total_note',
        'total_registered',
        'num_favorite',
        'num_season',
        'num_chapter',
        'ip_api',
    ];

    public function valuations()
    {
        return $this->hasMany(Valuation::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
