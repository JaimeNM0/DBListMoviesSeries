<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'character',
        'photo',
        'id_actor',
        'movies_id',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
