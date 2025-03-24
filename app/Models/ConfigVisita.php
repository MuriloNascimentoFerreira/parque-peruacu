<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigVisita extends Model
{
    use HasFactory;

    protected $table = 'config_visitas';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'visitantes_por_condutor',
    ];

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }
}
