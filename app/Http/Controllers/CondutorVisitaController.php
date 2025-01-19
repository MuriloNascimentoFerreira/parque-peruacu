<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondutorVisitaRequest;
use App\Models\Condutor;
use App\Models\Visita;
use App\Traits\GetCondutoresHabilitados;
use Exception;

/**
 * Classe responsável por vincular roteiros a uma visita
 */
class CondutorVisitaController extends Controller
{
    use GetCondutoresHabilitados;
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
        try{
            $condutores = Condutor::whereIn('id', $request->condutores)->get();
            if($visita->quantidadePessoasEfetivo < count($condutores)){
                return redirect()->back()->with('error', 'Muitos condutores selecionados! Quantidade de condutores deve ser: ' . $visita->quantidadePessoasEfetivo);
            }

            if($visita->quantidadePessoasEfetivo > count($condutores)){
                return redirect()->back()->with('error', 'Poucos condutores selecionados! Quantidade de condutores deve ser: ' . $visita->quantidadePessoasEfetivo);
            }

            // vincula os condutores que precisam ser vinculados
            $visita->condutores()->sync($condutores->pluck('id')->toArray());

            // Verificar se todos os roteiros possuem um condutor habilitado
            $roteirosComCondutorHabilitado = 0;
            $visita->load('roteiros'); // Carrega a relação
            $roteirosIds = $visita->roteiros->pluck('id'); // Agora pluck deve funcionar

            foreach ($visita->condutores as $condutor) {

                // Obter todos os roteiros habilitados para o condutor de uma vez
                $condutor->load('roteiros');
                $roteirosHabilitados = $condutor->roteiros()->pluck('roteiros.id');

                // Verifica quantos roteiros da visita estão habilitados pelo condutor
                foreach ($roteirosIds as $roteiroId) {
                    if ($roteirosHabilitados->contains($roteiroId)) {
                        $roteirosComCondutorHabilitado++;
                    }
                }
            }

            if($roteirosComCondutorHabilitado < count($visita->roteiros)){
                return redirect()->back()->with('error', 'É obrigatório ao menos um condutor habilitado para todos os roteiros selecionados!');
            }

            //Redirecionar para a tela de cadastro de agendamento.

            // Só por enquanto
            return redirect()->route('visitas.index')->with('success', 'Visita criada com sucesso!');

        } catch(Exception $e){
            report($e);
            return redirect()->route('visitas.index')->with('error', 'Erro ao vincular condutores!');
        }
    }

    public function edit(Visita $visita)
    {
        //O condutor é listado quando é habilitado para no minimo um dos roteiros
        $condutores = $this->getCondutoresHabilitados($visita->roteiros);

        return view('condutorVisita.edit', compact('condutores', 'visita'));
    }

    public function update(CondutorVisitaRequest $request, Visita $visita)
    {
        try{
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

            // Verificar se todos os roteiros possuem um condutor habilitado
            $roteirosComCondutorHabilitado = 0;
            $visita->load('roteiros'); // Carrega a relação
            $roteirosIds = $visita->roteiros->pluck('id'); // Agora pluck deve funcionar

            foreach ($visita->condutores as $condutor) {

                // Obter todos os roteiros habilitados para o condutor de uma vez
                $condutor->load('roteiros');
                $roteirosHabilitados = $condutor->roteiros()->pluck('roteiros.id');

                // Verifica quantos roteiros da visita estão habilitados pelo condutor
                foreach ($roteirosIds as $roteiroId) {
                    if ($roteirosHabilitados->contains($roteiroId)) {
                        $roteirosComCondutorHabilitado++;
                    }
                }
            }

            if($roteirosComCondutorHabilitado < count($visita->roteiros)){
                return redirect()->back()->with('error', 'É obrigatório ao menos um condutor habilitado para todos os roteiros selecionados!');
            }

            return redirect()->route('visitas.index')->with('success', 'Visita editada com sucesso!');
        } catch(Exception $e){
            report($e);
            return redirect()->route('visitas.index')->with('error', 'Erro ao atualizar e vincular condutores!');
        }
    }
}


