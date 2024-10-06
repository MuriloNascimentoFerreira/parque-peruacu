<?php

namespace App\Services;

use App\Models\Condutor;
use App\Models\Localidade;

class CondutorService{

    public function create($data){

        $condutor = new Condutor();
        $condutor->fill($data);

        $localidade = new Localidade();
        $localidade->fill($data);
        $localidade->save();

        $condutor->localidade()->associate($localidade);
        $condutor->save();

        return $condutor;
    }

    public function update($condutor, $data){
        $condutor->update($data);
        $condutor->localidade->update($data);
        return $condutor;
    }

}
