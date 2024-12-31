<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoteiroVisitaRequest;
use App\Models\Condutor;
use App\Models\Roteiro;
use App\Models\Visita;
use App\Repositories\RoteiroRepository;

/**
 * Classe responsável por vincular roteiros a uma visita
 */
class RoteiroVisitaController extends Controller
{

    public function create(Visita $visita, RoteiroRepository $roteiroRepository)
    {
        $roteiros = $roteiroRepository->findAllDate($visita);

        // Listar apenas os roteiros disponiveis.
        // Ou seja, verificar os roteiros que tem vagas disponiveis para esse dia, para o número de pessoas solicitado
        return view('roteiroVisita.create', compact('roteiros', 'visita'));
    }

    public function store(RoteiroVisitaRequest $request, Visita $visita)
    {
        $roteiros = Roteiro::whereIn('id', $request->roteiros)->get();

        $roteirosRequest = $request->input('roteiros'); // array de IDs de roteiros recebido pela request
        $roteirosExistentes = $visita->roteiros->pluck('id')->toArray(); // array de IDs de roteiros já relacionados

        $roteirosParaDetacher = array_diff($roteirosExistentes, $roteirosRequest); // array de IDs de roteiros que precisam ser desvinculados

        $visita->roteiros()->detach($roteirosParaDetacher);

        $visita->roteiros()->sync($roteiros->pluck('id')->toArray());

        return redirect()->route('condutor-visita.create', ['visita' => $visita->id]);
    }

    public function edit(Visita $visita)
    {
        $roteiros = Roteiro::all();
        return view('roteiroVisita.edit', compact('roteiros', 'visita'));
    }

    public function update(RoteiroVisitaRequest $request, Visita $visita)
    {
        $roteiros = Roteiro::whereIn('id', $request->roteiros)->get();

        $roteirosRequest = $request->input('roteiros'); // array de IDs de roteiros recebido pela request
        $roteirosExistentes = $visita->roteiros->pluck('id')->toArray(); // array de IDs de roteiros já relacionados

        $roteirosParaDetacher = array_diff($roteirosExistentes, $roteirosRequest); // array de IDs de roteiros que precisam ser desvinculados

        $visita->roteiros()->detach($roteirosParaDetacher);

        $visita->roteiros()->sync($roteiros->pluck('id')->toArray());

        return redirect()->route('condutor-visita.create', ['visita' => $visita->id]);
    }
}
