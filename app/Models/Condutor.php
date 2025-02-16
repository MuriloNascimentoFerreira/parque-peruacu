<?php

namespace App\Models;

use App\Models\Enums\Escolaridade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condutor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'condutores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'apelido',
        'email',
        'linguasEstrangeiras',
        'escolaridade',
        'instagram',
        'facebook',
        'informacoes',
        'localidade_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'escolaridade' => Escolaridade::class,
    ];

    protected $hidden = ['localidade_id'];

    public function localidade()
    {
        return $this->belongsTo(Localidade::class);
    }

    public function roteiros()
    {
        return $this->belongsToMany(Roteiro::class, 'condutor_roteiro');
    }

    public function getRoteirosNomes()
    {
        return implode(', ', $this->roteiros()->pluck('nome')->toArray());
    }

    public function visitas()
    {
        return $this->belongsToMany(visita::class, 'condutor_roteiro');
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['nome'] = $this->nome;
        $data['apelido'] = $this->apelido;
        $data['escolaridade'] = $this->escolaridade->getDescription();
        $data['localidade'] = $this->localidade->toArray();
        $data['linguasEstrangeiras'] = $this->linguasEstrangeiras;
        $data['instagram'] = $this->instagram;
        $data['facebook'] = $this->facebook;
        $data['informacoes'] = $this->informacoes;
        return $data;
    }
}

