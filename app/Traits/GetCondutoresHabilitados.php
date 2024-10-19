<?php

namespace App\Traits;

use App\Models\Roteiro;
use Illuminate\Database\Eloquent\Collection;

trait GetCondutoresHabilitados
{
    public function getCondutoresHabilitados(Collection $roteiros)
    {
        $condutores = new Collection();

        foreach ($roteiros as $roteiro) {
            $condutores->push($roteiro->condutores);
        }

        // Achata a coleção para retornar apenas uma coleção de condutores e sem repetidos
        $condutoresUnicos = $condutores->flatten()->unique('id');

        // Por fim, retorne apenas os condutores habilitados
        return $condutoresUnicos;
    }
}
