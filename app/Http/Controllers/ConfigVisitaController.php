<?php

namespace App\Http\Controllers;

use App\Models\ConfigVisita;
use Exception;
use Illuminate\Http\Request;

class ConfigVisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configVisita = ConfigVisita::orderBy('id', 'desc')->first();

        return view('configVisita.index')
            ->with('configVisita', $configVisita);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConfigVisita  $configVisita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfigVisita $configVisita)
    {

        try{
            $request->validate([
                'visitantes_por_condutor' => 'required'
            ]);
            $configVisita->update($request->all());

            return redirect()->route('config-visita.index')->with('success', 'Configuração editada com sucesso!');
        } catch(Exception $e){
            report($e);
            return redirect()->route('config-visita.index')->with('error', 'Erro ao editar uma configuração!');
        }
    }
}
