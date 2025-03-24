<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telefone extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'descricao',
        'numero',
        'agendamento_id'
    ];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function condutor()
    {
        return $this->belongsTo(Condutor::class);
    }
}
