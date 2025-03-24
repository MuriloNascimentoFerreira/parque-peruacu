<?php

namespace App\Services;

use App\Models\Condutor;
use App\Models\Localidade;
use App\Models\Telefone;

class CondutorService{

    public function create($data){

        $condutor = new Condutor();
        $condutor->fill($data);

        $localidade = new Localidade();
        $localidade->fill($data);
        $localidade->save();

        $condutor->localidade()->associate($localidade);
        $condutor->save();

        $telefone = new Telefone();
        $telefone->fill($data);
        $telefone->condutor()->associate($condutor);
        $telefone->save();

        return $condutor;
    }

    public function update($condutor, $data){
        $condutor->update($data);
        $condutor->localidade->update($data);
        $condutor->telefones->first()->update($data);
        return $condutor;
    }

}
