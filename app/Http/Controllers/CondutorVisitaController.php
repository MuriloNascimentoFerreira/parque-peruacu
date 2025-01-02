<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondutorVisitaRequest;
use App\Http\Requests\RoteiroVisitaRequest;
use App\Models\Condutor;
use App\Models\Roteiro;
use App\Models\Visita;
use App\Traits\GetCondutoresHabilitados;
use App\Traits\VerificaDisponibilidadeVisita;

/**
 * Classe responsável por vincular roteiros a uma visita
 */
class CondutorVisitaController extends Controller
{
    use GetCondutoresHabilitados, VerificaDisponibilidadeVisita;
    public function create(Visita $visita)
    {
        //O condutor é listado quando é habilitado para no minimo um dos roteiros
        $condutores = $this->getCondutoresHabilitados($visita->roteiros);

        return view('condutorVisita.create', compact('condutores', 'visita'));
    }

    /**
     * @todo criar um service.
     *
     * @param CondutorVisitaRequest $request
     * @param Visita $visita
     * @return void
     */
    public function store(CondutorVisitaRequest $request, Visita $visita)
    {
        $condutores = Condutor::whereIn('id', $request->condutores)->get();

        $condutoresRequest = $request->input('condutores'); // array de IDs de condutores recebido pela request
        $condutoresExistentes = $visita->condutores->pluck('id')->toArray(); // array de IDs de condutores já relacionados

        $condutoresParaDetacher = array_diff($condutoresExistentes, $condutoresRequest); // array de IDs de condutores que precisam ser desvinculados

        $visita->condutores()->detach($condutoresParaDetacher);

        $visita->condutores()->sync($condutores->pluck('id')->toArray());

        $roteirosComCondutorHabilitado = 0;
        // verificar se todos os roteiros possuem um condutor habilitado
        foreach ($visita->roteiros as $roteiro) {
            foreach($visita->condutores as $condutor){
                // verifica se um roteiros que o condutor é habilitado, é igual ao roteiro da visita

                if($condutor->roteiros()->get()->contains('id', $roteiro->id)){
                    $roteirosComCondutorHabilitado++;
                    break;
                }
            }
        }

        if($roteirosComCondutorHabilitado < count($visita->roteiros)){
            return redirect()->back()->with('error', 'É obrigatório ao menos um condutor habilitado para todos os roteiros selecionados!');
        }

        if($this->verificaDisponibilidadeVisita($visita)){
            return redirect()->route('visitas.index')->with('success', 'Visita criada com sucesso!');
        }

        /**
         * @todo Rodar uma comando para apagar tudo que já tinha sido criado.
         */

        return redirect()->route('visitas.index')->with('error', 'Vagas indisponíveis para essa data.');
    }

    public function edit(Visita $visita)
    {
        //O condutor é listado quando é habilitado para no minimo um dos roteiros
        $condutores = $this->getCondutoresHabilitados($visita->roteiros);

        return view('condutorVisita.edit', compact('condutores', 'visita'));
    }

    public function update(CondutorVisitaRequest $request, Visita $visita)
    {
        $condutores = Condutor::whereIn('id', $request->condutores)->get();

        // array de IDs de condutores recebido pela request
        $condutoresRequest = $request->input('condutores');

        // array de IDs de condutores já relacionados
        $condutoresExistentes = $visita->condutores->pluck('id')->toArray();

        // array de IDs de condutores que precisam ser desvinculados
        $condutoresParaDetacher = array_diff($condutoresExistentes, $condutoresRequest);

        // desvincula os condutores que precisam ser desvinculados
        $visita->condutores()->detach($condutoresParaDetacher);

        // vincula os condutores que precisam ser vinculados
        $visita->condutores()->sync($condutores->pluck('id')->toArray());

        // verifica se todos os roteiros possuem um condutor habilitado
        $roteirosComCondutorHabilitado = 0;
        foreach ($visita->roteiros as $roteiro) {
            foreach($visita->condutores as $condutor){
                // verifica se um dos roteiros que o condutor é habilitado, é igual ao roteiro da visita
                if($condutor->roteiros()->get()->contains('id', $roteiro->id)){
                    $roteirosComCondutorHabilitado++;
                    break;
                }
            }
        }

        if($roteirosComCondutorHabilitado < count($visita->roteiros)){
            return redirect()->back()->with('error', 'É obrigatório ao menos um condutor habilitado para todos os roteiros selecionados!');
        }

        return redirect()->route('visitas.index')->with('success', 'Visita editada com sucesso!');
    }
}


