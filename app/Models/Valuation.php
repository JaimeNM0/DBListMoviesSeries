<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valuation extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'opinion',
        'brand',
        'favorite',
        'start_date',
        'end_date',
        'users_id',
        'movies_id',
        'series_id',
    ];

    /**
     * Encansula la restricción de contenido entre movies_id y series_id de Valuation.
     */
    public function scopeFilterByContent($query, $content)
    {
        return $query->whereNotNull($content . '_id');
    }

    /**
     * Encansula la restricción de marcas y contenido entre movies_id y series_id de Valuation.
     */
    public function scopeFilterByBrandAndContent($query, $brand, $content)
    {
        return $query->where('brand', $brand)
            ->whereNotNull($content . '_id');
    }

    /**
     * Trae el usuario de la valoración.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Trae la película de la valoración.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movies_id');
    }

    /**
     * Trae la serie de la valoración.
     */
    public function serie()
    {
        return $this->belongsTo(Serie::class, 'series_id');
    }
}
