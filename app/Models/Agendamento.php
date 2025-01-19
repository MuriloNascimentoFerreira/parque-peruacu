<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Enums\Situacao;


class Agendamento extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomeResponsavel',
        'email',
        'motivo',
        'situacao',
        'localidade_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'date',
        'situacao' => Situacao::class,
    ];

    public function localidade()
    {
        return $this->belongsTo(Localidade::class);
    }

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }

    // cria relacionamento de um para um com visita
    public function visita()
    {
        return $this->hasOne(Visita::class, 'agendamento_id');
    }
}
