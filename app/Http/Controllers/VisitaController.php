<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitaRequest;
use App\Models\ConfigVisita;
use App\Models\Enums\Profile;
use App\Models\Enums\Situacao;
use App\Models\Roteiro;
use App\Models\Visita;
use App\Services\VisitaService;
use App\Traits\VerificaDisponibilidade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VisitaController extends Controller
{
    use VerificaDisponibilidade;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->profile === Profile::USER_VISITANTE){
        return abort(403, 'Acesso não autorizado');
        }
        $entities = Visita::paginate(10);
        return view('visita.index')->with('entities', $entities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roteiros = Roteiro::all();

        // Necessário para que o js valide a quantidade de condutores de acordo com a quantidade de visitantes no front
        $visitantesPorCondutor = ConfigVisita::orderBy('id', 'desc')->first()->visitantes_por_condutor;

        return view('visita.create')
            ->with('roteiros', $roteiros)
            ->with('visitantesPorCondutor', $visitantesPorCondutor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitaRequest $request, VisitaService $service)
    {
        try{

            $numeroCondutorPorVisitantes = ConfigVisita::orderBy('id', 'desc')->first()->visitantes_por_condutor;
            // Verifica se a quantidade de pessoas para cada condutor ultrapassa o limite
            if($request->quantidadePessoas/$request->quantidadePessoasEfetivo > $numeroCondutorPorVisitantes){
                return redirect()->route('visitas.create')->with('error', sprintf('A quantidade de pessoas devem ser de %d pessoas para um condutor', $numeroCondutorPorVisitantes));
            }

            // Para não adicionar mais de uma visita para o mesmo dia de uma mesma pessoa
            $visitaRepetida = Visita::query()
                ->where('data', $request->data)
                ->whereHas('agendamento', function ($agendamentoQuery) {
                    $agendamentoQuery->whereNotIn('situacao', [Situacao::SITUACAO_RECUSADA, Situacao::SITUACAO_CANCELADA]);
                })
                ->first();

            if( isset($visitaRepetida) && auth()->user()->id === $visitaRepetida->user->id){

                if(isset($visitaRepetida->agendamento)){
                    return redirect()->route('agendamentos.index')->with('error', 'Já existe uma visita agendada para esse dia!<br>Cancele ela para criar uma nova');
                }

                $visitaRepetida->roteiros()->detach();
                $visitaRepetida->condutores()->detach();
                $visitaRepetida->delete();
            }

            if(!$this->verificaDisponibilidadeVisita($request->all())){
                return redirect()->route('visitas.create')->with('error', 'Quantidade de vagas disponíveis para essa data é insuficiente! Volte ao calendário para verificar as vagas disponíveis!');
            }

            $entity = $service->create($request->all());
            if($entity){
                return redirect()->route('roteiro-visita.create', ['visita' => $entity->id]);
            }
        } catch(Exception $e){
            report($e);
            return Redirect::back()->with('error', 'Erro ao criar uma visita!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show(Visita $visita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(Visita $visita)
    {
        return view('visita.edit', ['entity' => $visita]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(VisitaRequest $request, Visita $visita)
    {
        try{
            if(!$this->verificaDisponibilidadeVisita($request->all())){
                return redirect()->route('visitas.edit', ['visita' => $visita])->with('error', 'Quantidade de vagas disponíveis para essa data é insuficiente! Volte ao calendário para verificar as vagas disponíveis!');
            }

            $result = $visita->update($request->all());
            if($result){
            return redirect()->route('roteiro-visita.edit', ['visita' => $visita->id]);
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('visitas.edit')->with('error', 'Erro ao editar uma visita!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visita $visita)
    {
        try{
            $visita->roteiros()->detach();
            $visita->condutores()->detach();

            if($visita->agendamento){
                $visita->agendamento->delete();
            }
            $result = $visita->delete();
            if($result){
                return redirect()->route('visitas.index')->with('success', 'Visita excluída com sucesso!');
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('visitas.index')->with('error', 'Erro ao excluir uma visita!');
        }
    }
}
