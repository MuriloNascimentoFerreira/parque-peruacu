<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendamentoRequest;
use App\Models\Agendamento;
use App\Models\Enums\Profile;
use App\Models\Enums\Situacao;
use App\Models\Visita;
use App\Notifications\StatusAprovadoNotification;
use App\Notifications\StatusRecusadoNotification;
use App\Services\AgendamentoService;
use Exception;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->profile === Profile::USER_VISITANTE){
            $entities = Agendamento::whereHas('visita', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->paginate(10);
            return view('agendamento.index')->with('entities', $entities);
        }
        $entities = Agendamento::orderBy('situacao')->paginate(10);
        return view('agendamento.index')->with('entities', $entities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Visita $visita)
    {
        return view('agendamento.create')->with('visita', $visita);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendamentoRequest $request, AgendamentoService $service)
    {
        try{
            $entity = $service->create($request->all());
            $visita = Visita::find($request->visita);

            if($entity){
                // associa um agendamento a visita
                $visita->agendamento()->associate($entity);
                $visita->save();
                return redirect()->route('agendamentos.index')->with('success', 'Sua solicitação de visita foi enviada com sucesso! <br> Aguarde aprovação que será enviada por e-mail.');
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao criar um agendamento!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Agendamento $agendamento)
    {
        // return view('agendamento.show')->with('agendamento', $agendamento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento)
    {
        return view('agendamento.edit')->with('entity', $agendamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgendamentoRequest $request, Agendamento $agendamento, AgendamentoService $service)
    {
        try{
            $result = $service->update($agendamento, $request->all());
            if($result){
                return redirect()->route('agendamentos.index')->with('success', 'Agendamento editado com sucesso!');
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao editar um agendamento!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {
        try{
            $agendamento->localidade->delete();
            $agendamento->telefones->first()->delete();
            if($agendamento->visita){
                $agendamento->visita->delete();
            }
            $result = $agendamento->delete();
            if($result){
                return redirect()->route('agendamentos.index')->with('success', 'Agendamento excluído com sucesso!');
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao excluir um agendamento!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelar(Agendamento $agendamento)
    {
        try{
            $agendamento->situacao = Situacao::SITUACAO_CANCELADA;
            $agendamento->save();
            $agendamento->refresh();

            if($agendamento->situacao == Situacao::SITUACAO_CANCELADA){
                return redirect()->route('agendamentos.index')->with('success', 'Agendamento cancelado com sucesso!');
            }
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao cancelar um agendamento!');
        } catch(Exception $e){
            report($e);
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao cancelar um agendamento!');
        }
    }

    public function aprovar(Agendamento $agendamento)
    {
            $agendamento->situacao = Situacao::SITUACAO_AGENDADA;
            $agendamento->save();
            $agendamento->refresh();

            if($agendamento->situacao == Situacao::SITUACAO_AGENDADA){

                $agendamento->notify(new StatusAprovadoNotification());
                return redirect()->route('agendamentos.index')->with('success', 'Agendamento aprovado com sucesso!');
            }
        try{

            return redirect()->route('agendamentos.index')->with('error', 'Erro ao aprovar um agendamento!');
        } catch(Exception $e){
            report($e);
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao aprovar um agendamento!');
        }
    }

    public function recusar(Agendamento $agendamento, Request $request)
    {
        try{
            $agendamento->situacao = Situacao::SITUACAO_RECUSADA;
            $agendamento->save();
            $agendamento->refresh();

            /**
             * @todo Notificar o visitante sobre a recusa do agendamento.
             * Com motivo da recusa.
             * $request->motivo
             */

            if($agendamento->situacao == Situacao::SITUACAO_RECUSADA){
                $agendamento->notify(new StatusRecusadoNotification());
                return redirect()->route('agendamentos.index')->with('success', 'Agendamento recusado com sucesso!');
            }
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao recusar um agendamento!');
        } catch(Exception $e){
            report($e);
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao recusar um agendamento!');
        }
    }
}
