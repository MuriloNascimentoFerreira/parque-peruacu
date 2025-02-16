<?php

namespace App\Models;

use App\Models\Enums\Periodo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;

class Visita extends Model
{
    use HasFactory, SoftDeletes;

    protected $cascadeDeletes = ['roteiros', 'condutores'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'data',
        'quantidadePessoas',
        'quantidadePessoasEfetivo',
        'periodo',
        'user_id',
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'periodo' => Periodo::class,
        'data' => 'date',
    ];

    public function roteiros()
    {
        return $this->belongsToMany(Roteiro::class, 'roteiro_visita');
    }

    public function condutores()
    {
        return $this->belongsToMany(Condutor::class, 'condutor_visita');
    }

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
