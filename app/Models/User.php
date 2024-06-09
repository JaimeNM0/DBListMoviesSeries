<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Valuation;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nick',
        'photo',
        'name',
        'surname',
        'phone',
        'birth_date',
        'email',
        'password',
    ];

    /**
     * Trae todas las valoraciones del usuario.
     */
    public function valuations()
    {
        return $this->hasMany(Valuation::class, 'users_id');
    }

    /**
     * Trae todas las valoraciones que coincidad con el contenido elegido del usuario.
     */
    public function filterByContentValuations($content)
    {
        return $this->valuations()->filterByContent($content)->get();
    }

    /**
     * Trae todas las valoraciones que coincidad con la marca y el contenido elegido del usuario.
     */
    public function filterByBrandAndContentValuations($brand, $content)
    {
        return $this->valuations()->filterByBrandAndContent($brand, $content)->get();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
