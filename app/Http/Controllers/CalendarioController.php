<?php

namespace App\Http\Controllers;

use App\Repositories\RoteiroRepository;
use Illuminate\Http\Request;

/**
 * Rotas para obter dados para preencher o calendário
 * respostas via ajax
 */
class CalendarioController extends Controller
{
    public function calendario(RoteiroRepository $roteiroRepository)
    {
        $roteiros = $roteiroRepository->findAllCalendar();
        $data = [];

        //retornar no minimo um evento para todos os dias do ano
        //Se não tiver nenhum agendamento para o dia, retornar um evento padrão com todas as datas disponiveis
        // se não , retornar a quantidade de vagas disponiveis para cada roteiro

        foreach ($roteiros as $item) {

            $data[] = [
                'id' => $item['id'],
                'title' => sprintf('%s %s/%s', $item['nome'], $item['vagas_disponiveis'], $item['lotacao']),
                'text' => '',
                'allDay' => true,
                'type' => 'alert',
                'backgroundColor' => 'Green',
                'borderColor' => 'Green',
                'url' => '',
                'start' => $item['data'],
                'end' => $item['data'],
            ];
        }

        return $data;
    }
}
