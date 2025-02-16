<?php

namespace App\Traits;

use App\Models\Roteiro;
use App\Models\Visita;
use App\Repositories\RoteiroRepository;

trait VerificaDisponibilidade
{
    /**
     * Verifica se a data de uma visita esta disponivel para cadastro.
     * Levando em consideração a soma da quantidade de pessoas solicitada + a quantidade de pessoas da visita marcada para mesma data(se for o caso).
     * Ainda não levando em consideração os roteiros pois ainda não foram escolhidos.
     * Portanto essa é uma verificação inicial.
     *
     * @param array $visita
     * @return bool
     */
    public function verificaDisponibilidadeVisita(array $visita)
    {
        $visitasComMesmaData = Visita::whereDate('data', $visita['data'])->get();

        if (isset($visitasComMesmaData) && count($visitasComMesmaData) == 0) return true;

        /**
         * Visitas na mesma data:
         *
         */
        foreach ($visitasComMesmaData as $visita) {
            //Soma a quantidade de pessoas solicitada + a quantidade de pessoas da visita marcada para mesma data
            $totalPessoasVisitantes = $visita->quantidadePessoas + $visita['quantidadePessoas'];
            foreach ($visita->roteiros as $roteiro) {

                if ($totalPessoasVisitantes <= $roteiro->lotacao) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Verifica se a data de uma visita esta disponivel para cadastro.
     * Verifica cada roteiro escolhido para essa visita se tem disponibilidade para aquela data.
     * @param Visita $visita
     * @return bool
     */
    public function verificaDisponibilidadeRoteiros(Visita $visita, array $roteirosIds)
    {
        $roteirosSolicitados = Roteiro::whereIn('id', $roteirosIds)->get();

        $repository = new RoteiroRepository();
        $roteirosDisponiveis = $repository->findAllDate($visita);

        foreach ($roteirosSolicitados as $roteiro) {
            $roteiroAtual = $roteirosDisponiveis->where('id', $roteiro->id)->first();
            if (isset($roteiroAtual) && $roteiroAtual->vagas_disponiveis < $visita->quantidadePessoas) {
                return false;
            }
        }
        return true;
    }
}
