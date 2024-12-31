<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitaConvidadoRequest;
use App\Models\Enums\Profile;
use App\Models\Roteiro;
use App\Models\Visita;
use Exception;
use Illuminate\Http\Request;

class VisitaConvidadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $entities = Visita::query()->where('user_responsavel_id', auth()->user()->id)->paginate(10);
        $entities = Visita::paginate(10);
        return view('visitaConvidado.index')->with('entities', $entities);
    }

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roteiros = Roteiro::all();
        // não mostrar todos os roteiros, mostrar apenas os roteiros ...
        return view('visitaConvidado.create')->with('roteiros', $roteiros);
    }
}
