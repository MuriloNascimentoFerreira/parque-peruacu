<?php

namespace App\Http\Controllers;

use App\Models\Visita;

class VisitaConvidadoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendario()
    {
        $entities = Visita::all();
        return view('visitaConvidado.calendario')->with('entities', $entities);
    }
}
