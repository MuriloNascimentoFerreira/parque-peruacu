<?php

namespace App\Models;

use App\Models\Enums\Niveis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roteiro extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'lotacao',
        'duracao',
        'nivel',
        'distancia',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'nivel' => Niveis::class,
    ];

    public function getHorasAttribute()
    {
        return floor($this->attributes['duracao'] / 60);
    }

    public function getMinutosAttribute()
    {
        return $this->attributes['duracao'] % 60;
    }

    public function getDistanciaAttribute()
    {
        return number_format($this->attributes['distancia'], 2, ',', '');
    }

    public function condutores()
    {
        return $this->belongsToMany(Condutor::class, 'condutor_roteiro');
    }

    public function visitas()
    {
        return $this->belongsToMany(Visita::class, 'roteiro_visita');
    }
}
