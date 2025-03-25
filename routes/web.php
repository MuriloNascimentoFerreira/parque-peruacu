<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CondutorController;
use App\Http\Controllers\CondutorVisitaController;
use App\Http\Controllers\ConfigVisitaController;
use App\Http\Controllers\HabilitarCondutorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoteiroController;
use App\Http\Controllers\RoteiroVisitaController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\VisitaConvidadoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* OBS: As rotas resource tem que está no plural para funcionamento correto */
    Route::resource('roteiros', RoteiroController::class);
    Route::resource('visitas', VisitaController::class);
    Route::resource('condutores', CondutorController::class)->parameters([
        'condutores' => 'condutor',
    ]);

    Route::get('/agendamentos', [AgendamentoController::class, 'index'])->name('agendamentos.index');
    Route::get('/agendamentos/create/{visita}', [AgendamentoController::class, 'create'])->name('agendamentos.create');
    Route::post('/agendamentos', [AgendamentoController::class, 'store'])->name('agendamentos.store');
    Route::get('/agendamentos/{agendamento}/edit', [AgendamentoController::class, 'edit'])->name('agendamentos.edit');
    Route::put('/agendamentos/{agendamento}', [AgendamentoController::class, 'update'])->name('agendamentos.update');
    Route::delete('/agendamentos/{agendamento}', [AgendamentoController::class, 'destroy'])->name('agendamentos.destroy');
    Route::put('/agendamentos/{agendamento}/cancelar', [AgendamentoController::class, 'cancelar'])->name('agendamentos.cancelar');
    Route::put('/agendamentos/{agendamento}/aprovar', [AgendamentoController::class, 'aprovar'])->name('agendamentos.aprovar');
    Route::put('/agendamentos/{agendamento}/recusar', [AgendamentoController::class, 'recusar'])->name('agendamentos.recusar');


    Route::post('condutores/habilitar-condutores/{condutor}', HabilitarCondutorController::class)->name('condutores.habilitar-condutores');

    Route::get('roteiro-visita/{visita}', [RoteiroVisitaController::class, 'create'])->name('roteiro-visita.create');
    Route::post('roteiro-visita/{visita}', [RoteiroVisitaController::class, 'store'])->name('roteiro-visita.store');
    Route::get('roteiro-visita/{visita}/edit', [RoteiroVisitaController::class, 'edit'])->name('roteiro-visita.edit');
    Route::put('roteiro-visita/{visita}', [RoteiroVisitaController::class, 'update'])->name('roteiro-visita.update');

    Route::get('condutor-visita/{visita}', [CondutorVisitaController::class, 'create'])->name('condutor-visita.create');
    Route::post('condutor-visita/{visita}', [CondutorVisitaController::class, 'store'])->name('condutor-visita.store');
    Route::get('condutor-visita/{visita}/edit', [CondutorVisitaController::class, 'edit'])->name('condutor-visita.edit');
    Route::put('condutor-visita/{visita}', [CondutorVisitaController::class, 'update'])->name('condutor-visita.update');

    Route::get('config-visita', [ConfigVisitaController::class, 'index'])->name('config-visita.index');
    Route::put('config-visita/{configVisita}', [ConfigVisitaController::class, 'update'])->name('config-visita.update');

});

// Retorna página do calendário com os roteiros disponiveis para o visitante.
Route::get('visitas-convidado/', [VisitaConvidadoController::class, 'calendario'])->name('visitas-convidado.calendario');

//Rota responsavel por retornar os roteiros e as vagas disponiveis para cada roteiro via ajax
Route::get('/calendario', [CalendarioController::class, 'calendario'])->name('calendario');


require __DIR__.'/auth.php';
