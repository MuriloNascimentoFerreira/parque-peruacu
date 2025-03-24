<?php

namespace App\Repositories;

use App\Models\Enums\Situacao;
use App\Models\Roteiro;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoteiroRepository
{
    /**
     * Encontra todos os registros dos 'Roteiros' para uma determinada data de 'Visita', calculando as vagas disponíveis.
     *
     * Esta função recupera uma coleção de registros 'Roteiro', unidos com 'roteiro_visita'
     * e tabelas 'visitas', filtradas pela data 'Visita' especificada. Ele calcula o total
     *número de pessoas para cada 'Roteiro' e determina as vagas disponíveis subtraindo
     *este total da lotação do Roteiro. Os resultados são agrupados por ID 'Roteiro'.
     *
     * @param Visita $visita O objeto 'Visita' contendo a data para filtrar os registros 'Roteiro'.
     * @return \Illuminate\Support\Collection Uma coleção de discos do 'Roteiro' com vagas disponíveis.
     */
    public function findAllDate($visita)
    {
        return Roteiro::query()
            ->leftJoin('roteiro_visita', 'roteiros.id', '=', 'roteiro_visita.roteiro_id')
            ->leftJoin('visitas', function ($join) use ($visita) {
                $join->on('visitas.id', '=', 'roteiro_visita.visita_id')
                    ->where('visitas.data', $visita->data);
            })
            ->leftJoin('agendamentos', 'visitas.agendamento_id', '=', 'agendamentos.id')
            ->where(function ($query) {
                $query->whereNull('agendamentos.situacao')
                      ->orWhereNotIn('agendamentos.situacao', [Situacao::SITUACAO_RECUSADA, Situacao::SITUACAO_CANCELADA]);
            })
            ->select('roteiros.id',
                'roteiros.lotacao',
                'roteiros.nome',
                DB::raw('COALESCE( SUM(visitas.quantidadePessoas), 0) as total_visitas'),
                DB::raw('(roteiros.lotacao - COALESCE( SUM(visitas.quantidadePessoas),0)) as vagas_disponiveis'))
            ->groupBy('roteiros.id')
            ->get();
    }

    /**
     * Igual a de cima mas para edição
     *
     * @param [type] $visita
     * @return void
     */
    public function findAllDateEdit($visita)
    {
        return Roteiro::query()
            ->leftJoin('roteiro_visita', 'roteiros.id', '=', 'roteiro_visita.roteiro_id')
            ->leftJoin('visitas', function ($join) use ($visita) {
                $join->on('visitas.id', '=', 'roteiro_visita.visita_id')
                    ->where('visitas.data', $visita->data);
            })
            ->leftJoin('agendamentos', 'visitas.agendamento_id', '=', 'agendamentos.id')
            ->where(function ($query) {
                $query->whereNull('agendamentos.situacao')
                      ->orWhereNotIn('agendamentos.situacao', [Situacao::SITUACAO_RECUSADA, Situacao::SITUACAO_CANCELADA]);
            })
            ->select('roteiros.id',
                'roteiros.lotacao',
                'roteiros.nome',
                DB::raw('COALESCE( SUM(CASE WHEN visitas.id <> ' . $visita->id . ' THEN visitas.quantidadePessoas ELSE 0 END), 0) as total_visitas'),
                DB::raw('(roteiros.lotacao - COALESCE( SUM(CASE WHEN visitas.id <> ' . $visita->id . ' THEN visitas.quantidadePessoas ELSE 0 END), 0)) as vagas_disponiveis'))
            ->groupBy('roteiros.id')
            ->get();
    }

    public function findAllCalendar()
    {
        // Define o ano que você deseja
        $ano = now()->yearIso;
        $datasDoAno = [];

        // Gera todas as datas do ano
        for ($m = 1; $m <= 12; $m++) {
            for ($d = 1; $d <= 31; $d++) {
                try {
                    $datasDoAno[] = Carbon::createFromDate($ano, $m, $d)->format('Y-m-d');
                } catch (\Exception $e) {
                    // Ignora datas inválidas (ex: 30 de fevereiro)
                }
            }
        }

        // Array para armazenar os resultados
        $resultados = [];

        foreach ($datasDoAno as $data) {
            $roteiros = Roteiro::with(['visitas' => function ($query) use ($data) {
                $query->where('data', $data)
                    ->whereHas('agendamento', function ($agendamentoQuery) {
                        $agendamentoQuery->whereNotIn('situacao', [Situacao::SITUACAO_RECUSADA, Situacao::SITUACAO_CANCELADA]);
                    });
            }])->get();

            foreach ($roteiros as $roteiro) {
                $totalVisitas = $roteiro->visitas->sum('quantidadePessoas');
                $vagasDisponiveis = $roteiro->lotacao - $totalVisitas;

                // Verifica se a data já foi adicionada
                $dataExistente = false;
                foreach ($resultados as $resultado) {
                    if ($resultado['data'] === $data && $resultado['id'] === $roteiro->id) {
                        $dataExistente = true;
                        break;
                    }
                }

                if ($dataExistente) {
                    continue;
                }

                // Adiciona cada roteiro como um elemento do array com a data correspondente
                $resultados[] = [
                    'data' => $data,
                    'id' => $roteiro->id,
                    'nome' => $roteiro->nome,
                    'lotacao' => $roteiro->lotacao,
                    'vagas_disponiveis' => max($vagasDisponiveis, 0),
                ];
            }
        }

        return $resultados;
    }
}


