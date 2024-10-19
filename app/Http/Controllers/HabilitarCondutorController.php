<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabilitarCondutorRequest;
use App\Models\Condutor;
use App\Models\Roteiro;

class HabilitarCondutorController extends Controller
{
    public function __invoke(HabilitarCondutorRequest $request, Condutor $condutor)
    {
        $roteiros = Roteiro::whereIn('id', $request->roteiros)->get();

        $roteirosRequest = $request->input('roteiros'); // array de IDs de roteiros recebido pela request
        $roteirosExistentes = $condutor->roteiros->pluck('id')->toArray(); // array de IDs de roteiros já relacionados

        $roteirosParaDetacher = array_diff($roteirosExistentes, $roteirosRequest); // array de IDs de roteiros que precisam ser desvinculados

        $condutor->roteiros()->detach($roteirosParaDetacher);

        $condutor->roteiros()->sync($roteiros->pluck('id')->toArray());

        return redirect()->route('condutores.index')->with('success', 'Condutor habilitado com sucesso!');
    }
}
