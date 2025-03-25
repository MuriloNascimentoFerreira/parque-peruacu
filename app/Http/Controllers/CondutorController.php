<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondutorRequest;
use App\Models\Condutor;
use App\Models\Localidade;
use App\Models\Roteiro;
use App\Models\Telefone;
use App\Services\CondutorService;
use Exception;
use Illuminate\Http\Request;

class CondutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verificar se é rota de api ou não
        if(request()->segment(1) == 'api'){
            return response()->json(Condutor::all()->toArray());
        }
        $roteiros = Roteiro::all();
        $entities = Condutor::paginate(10);
        return view('condutor.index')->with('entities', $entities)->with('roteiros', $roteiros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('condutor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CondutorRequest $request, CondutorService $service)
    {
        try{
            $entity = $service->create($request->all());
            if($entity){
                return redirect()->route('condutores.index')->with('success', 'Novo condutor criado com sucesso!');
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('condutores.index')->with('error', 'Erro ao criar um condutor!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Condutor $condutor)
    {
        return view('condutor.edit', ['entity' => $condutor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CondutorRequest $request, Condutor $condutor, CondutorService $service)
    {
        try{
            $result = $service->update($condutor, $request->all());
            if($result){
                return redirect()->route('condutores.index')->with('success', 'Condutor editado com sucesso!');
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('condutores.index')->with('error', 'Erro ao editar um condutor!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condutor $condutor)
    {
        try{
            $condutor->localidade()->delete();
            $result = $condutor->delete();
            if($result){
                return redirect()->route('condutores.index')->with('success', 'Condutor excluído com sucesso!');
            }
        } catch(Exception $e){
            report($e);
            return redirect()->route('condutores.index')->with('error', 'Erro ao excluir um condutor!');
        }
    }
}
