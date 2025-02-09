<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Support\Facades\Artisan;

class VisitaConvidadoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendario()
    {
        // Chama o comando Artisan
        Artisan::call('visitas:clean');

        $entities = Visita::all();
        return view('visitaConvidado.calendario')->with('entities', $entities);
    }
}
