<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidade extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cep',
        'cidade',
        'uf',
        'pais'
    ];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function condutor()
    {
        return $this->belongsTo(Condutor::class);
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['cep'] = $this->cep;
        $data['cidade'] = $this->cidade;
        $data['uf'] = $this->uf;
        $data['pais'] = $this->pais;
        return $data;
    }
}
