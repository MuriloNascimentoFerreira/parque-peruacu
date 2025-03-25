<?php

namespace App\Services;

use App\Models\Agendamento;
use App\Models\ConfigVisita;
use App\Models\Localidade;
use App\Models\Telefone;
use App\Models\Visita;

class VisitaService{

    public function create($data){

        $visita = new Visita();
        $visita->fill($data);

        //Pegar o id da config de visita padrao
        $visita->config_visita_id = ConfigVisita::orderBy('id', 'desc')->first()->id;

        $visita->save();
        return $visita;
    }

    public function update($agendamento, $data){
        $agendamento->update($data);
        $agendamento->telefones->first()->update($data);
        $agendamento->localidade->update($data);
        return $agendamento;
    }

}
