<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoteiroVisitaRequest;
use App\Models\Roteiro;
use App\Models\Visita;
use App\Repositories\RoteiroRepository;
use App\Traits\VerificaDisponibilidade;
use Exception;

/**
 * Classe responsável por vincular roteiros a uma visita
 */
class RoteiroVisitaController extends Controller
{
    use VerificaDisponibilidade;
    public function create(Visita $visita, RoteiroRepository $roteiroRepository)
    {
        $roteiros = $roteiroRepository->findAllDate($visita);

        // Listar apenas os roteiros disponiveis.
        // Ou seja, verificar os roteiros que tem vagas disponiveis para esse dia, para o número de pessoas solicitado
        return view('roteiroVisita.create', compact('roteiros', 'visita'));
    }

    public function store(RoteiroVisitaRequest $request, Visita $visita)
    {
        try{
            if(!$this->verificaDisponibilidadeRoteiros($visita, $request->roteiros)){
                return redirect()->back()->with('error', 'Quantidade de vagas disponíveis para essa data é insuficiente! Volte ao calendário para verificar as vagas disponíveis!');
            }

            $roteiros = Roteiro::whereIn('id', $request->roteiros)->get();

            // vincula os roteiros que precisam ser vinculados
            $visita->roteiros()->sync($roteiros->pluck('id')->toArray());

            return redirect()->route('condutor-visita.create', ['visita' => $visita->id]);
        } catch(Exception $e){
            report($e);
            return redirect()->route('visitas.index')->with('error', 'Erro ao vincular roteiros!');
        }
    }

    public function edit(Visita $visita, RoteiroRepository $roteiroRepository)
    {
        $roteiros = $roteiroRepository->findAllDateEdit($visita);
        return view('roteiroVisita.edit', compact('roteiros', 'visita'));
    }

    public function update(RoteiroVisitaRequest $request, Visita $visita)
    {

        if(!$this->verificaDisponibilidadeRoteiros($visita, $request->roteiros)){
            return redirect()->back()->with('error', 'Quantidade de vagas disponíveis para essa data é insuficiente! Volte ao calendário para verificar as vagas disponíveis!');
        }
        try{
            $roteiros = Roteiro::whereIn('id', $request->roteiros)->get();

            $roteirosRequest = $request->input('roteiros'); // array de IDs de roteiros recebido pela request
            $roteirosExistentes = $visita->roteiros->pluck('id')->toArray(); // array de IDs de roteiros já relacionados

            $roteirosParaDetacher = array_diff($roteirosExistentes, $roteirosRequest); // array de IDs de roteiros que precisam ser desvinculados

            $visita->roteiros()->detach($roteirosParaDetacher);

            $visita->roteiros()->sync($roteiros->pluck('id')->toArray());

            return redirect()->route('condutor-visita.edit', ['visita' => $visita->id]);
        } catch(Exception $e){
            report($e);
            return redirect()->route('visitas.index')->with('error', 'Erro ao atualizar e vincular roteiros!');
        }
    }
}
