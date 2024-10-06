<?php

namespace App\Services;

use App\Models\Agendamento;
use App\Models\Localidade;
use App\Models\Telefone;

class AgendamentoService{

    public function create($data){

        $agendamento = new Agendamento();
        $agendamento->fill($data);

        $localidade = new Localidade();
        $localidade->fill($data);
        $localidade->save();

        $agendamento->localidade()->associate($localidade);
        $agendamento->save();

        $telefone = new Telefone();
        $telefone->fill($data);
        $telefone->agendamento()->associate($agendamento);
        $telefone->save();

        return $agendamento;
    }

    public function update($agendamento, $data){
        $agendamento->update($data);
        $agendamento->telefones->first()->update($data);
        $agendamento->localidade->update($data);
        return $agendamento;
    }

}
