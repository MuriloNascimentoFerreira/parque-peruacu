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
        'localidade',
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

    public function localidade()
    {
        return $this->belongsTo(Localidade::class);
    }
}
