<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoteiroRequest;
use App\Models\Roteiro;
use Exception;
use Illuminate\Http\Request;

class RoteiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Roteiro::all();

        // $entities = Roteiro::paginate(10);
        return view('roteiro.index')->with('entities', $entities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roteiro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoteiroRequest $request)
    {
        try{
            $entity = Roteiro::create($request->all());

            if($entity){
                return redirect()->route('roteiros.index')->with('success', 'Novo roteiro criado com sucesso!');
            }

        } catch(Exception $e){
            report($e);

            return redirect()->route('roteiros.index')->with('error', 'Erro ao criar um roteiro!');
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
    public function edit(Roteiro $roteiro)
    {
        return view('roteiro.edit', ['entity' => $roteiro]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoteiroRequest $request, Roteiro $roteiro)
    {
        try{
            $result = $roteiro->update($request->all());

            if($result){
                return redirect()->route('roteiros.index')->with('success', 'Roteiro editado com sucesso!');
            }

        } catch(Exception $e){
            report($e);

            return redirect()->route('roteiros.index')->with('error', 'Erro ao editar um roteiro!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roteiro $roteiro)
    {
        try{
            $roteiro->delete();
            return redirect()->route('roteiros.index')->with('success', 'Roteiro excluído com sucesso!');
        } catch(Exception $e){
            report($e);
            return redirect()->route('roteiros.index')->with('error', 'Erro ao excluir um roteiro!');
        }
    }
}
