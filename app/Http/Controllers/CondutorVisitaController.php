<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondutorVisitaRequest;
use App\Models\Condutor;
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
        //quando selecionar apenas um condutor verificar se ele está habilitado para todos os roteiros
        $condutores = Condutor::whereIn('id', $request->condutores)->get();

        $condutoresRequest = $request->input('condutores'); // array de IDs de condutores recebido pela request
        $condutoresExistentes = $visita->condutores->pluck('id')->toArray(); // array de IDs de condutores já relacionados

        $condutoresParaDetacher = array_diff($condutoresExistentes, $condutoresRequest); // array de IDs de condutores que precisam ser desvinculados

        $visita->condutores()->detach($condutoresParaDetacher);

        $visita->condutores()->sync($condutores->pluck('id')->toArray());

        // verificar se todos os roteiros possuem um condutor habilitado
        foreach ($visita->roteiros as $roteiro) {

            if (empty($roteiro->condutores()->get()->count()) ||
                !$roteiro->condutores()->get()->contains('id', $visita->condutores()->get()->first()->id)
            ){

                return redirect()->back()->with('error', 'É obrigatório ao menos um condutor habilitado para todos os roteiros selecionados!');
            }
        }

        if($this->verificaDisponibilidadeVisita($visita)){

            return redirect()->route('visitas.index')->with('success', 'Visita criada com sucesso!');
        }

        /**
         * @todo Rodar uma comando para apagar tudo que já tinha sido criado.
         */

        return redirect()->route('visitas.index')->with('error', 'Vagas indisponíveis para essa data.');
    }

    // public function edit(Visita $visita)
    // {
    //     $roteiros = Roteiro::all();
    //     return view('roteiroVisita.edit', compact('roteiros', 'visita'));
    // }

    // public function update(RoteiroVisitaRequest $request, Visita $visita)
    // {
    //     $roteiros = Roteiro::whereIn('id', $request->roteiros)->get();

    //     $roteirosRequest = $request->input('roteiros'); // array de IDs de roteiros recebido pela request
    //     $roteirosExistentes = $visita->roteiros->pluck('id')->toArray(); // array de IDs de roteiros já relacionados

    //     $roteirosParaDetacher = array_diff($roteirosExistentes, $roteirosRequest); // array de IDs de roteiros que precisam ser desvinculados

    //     $visita->roteiros()->detach($roteirosParaDetacher);

    //     $visita->roteiros()->sync($roteiros->pluck('id')->toArray());

    //     return redirect()->route('visitas.index')->with('success', 'Visita editada com sucesso!');
    // }
}


