<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitaRequest;
use App\Models\Enums\Profile;
use App\Models\Roteiro;
use App\Models\Visita;
use App\Traits\VerificaDisponibilidadeVisita;
use Exception;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    use VerificaDisponibilidadeVisita;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->profile === Profile::USER_VISITANTE){
            $entities = Visita::query()->where('user_id', auth()->user()->id)->paginate(10);
            $entities = Visita::paginate(10);
            return view('visita.index')->with('entities', $entities);
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
        return view('visita.create')->with('roteiros', $roteiros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitaRequest $request)
    {
        try{
            // Verifica se a quantidade de pessoas para cada condutor ultrapassa 8
            if($request->quantidadePessoas/$request->quantidadePessoasEfetivo > 8){
                return redirect()->route('visitas.index')->with('error', 'A quantidade de pessoas devem ser  de 8 pessoas para um condutor');
            }
            // Para não adicionar mais de uma visita para o mesmo dia de uma mesma pessoa
            if(Visita::query()->where('data', $request->data)->first() && auth()->user()->id === Visita::query()->where('data', $request->data)->first()->user->id){
                return redirect()->route('visitas.index')->with('error', 'Já existe uma visita sua para esta data. Clique para alterá-la!');
            }

            if(!$this->verificaDisponibilidadeVisita($request->all())){
                return redirect()->route('visitas.index')->with('error', 'Quantidade de vagas disponíveis para essa data é insuficiente! Volte ao calendário para verificar as vagas disponíveis!');
            }

            $entity = Visita::create($request->all());
            if($entity){
                return redirect()->route('roteiro-visita.create', ['visita' => $entity->id]);
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('visitas.index')->with('error', 'Erro ao criar uma visita!');
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
            $result = $visita->update($request->all());
            if($result){
            return redirect()->route('roteiro-visita.edit', ['visita' => $visita->id]);
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('visitas.index')->with('error', 'Erro ao editar uma visita!');
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
