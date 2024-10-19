<?php

namespace App\Services;

use App\Models\Agendamento;
use App\Models\Localidade;
use App\Models\Telefone;
use App\Models\Visita;

class VisitaService{

    public function create($data){

        $visita = new Visita();
        $visita->fill($data);


        // a lotação maxima do roteiro é por dia
        //Fazer uma consulta para verificar se o roteiro tem lotação maxima por dia
        //Ou seja se o roteiro está disponivel para aquela data da visita.
        //Pegar toda visita que tem relacionamento com um roteiro x, que seja na mesma data da visita solicitada, e que a quantidade de pessoas seja menor que a quantidade de pessoas solicitada pela nova visita.

        return $visita;
    }

    public function update($agendamento, $data){
        $agendamento->update($data);
        $agendamento->telefones->first()->update($data);
        $agendamento->localidade->update($data);
        return $agendamento;
    }

}
