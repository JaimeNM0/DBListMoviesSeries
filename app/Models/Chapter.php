<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'num_season',
        'num_chapter',
        'start_date',
        'series_id',
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
