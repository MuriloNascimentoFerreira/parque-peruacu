<?php

namespace App\Traits;

use App\Models\Visita;

trait VerificaDisponibilidadeVisita
{
    /**
     * Verifica se a data de uma visita esta disponivel para cadastro.
     * A verificacao consiste em somar a quantidade de pessoas de todas as visitas do mesmo dia e verificar se a soma e menor
     * que a lotacao do roteiro com a menor lotacao.
     *
     * @param array $visita
     * @return bool
     */
    public function verificaDisponibilidadeVisita(array $visita)
    {
        $visitasComMesmaData = Visita::whereDate('data',$visita['data'])->get();

        if(empty($visitasComMesmaData)) return true;

        $totalPessoasVisitantes = $visitasComMesmaData->sum('quantidadePessoas') + $visita['quantidadePessoas'];

        /**
         * Visitas na mesma data:
         *
         * visita 1 = 15 pessoas -> roteiroA (lotacao 30)
         *                       -> roteiroB (lotacao 32)
         *
         * visita 2 = 15 pessoas -> roteiroA (lotacao 30)
         *                       -> roteiroB (lotacao 32)
         *
         * quantidade de pessoas => (15 + 15) = 30
         *
         * Vagas livres = 0
         * (Pois é levado em consideração o roteiro com menor lotacao)
         *
         */
        foreach($visitasComMesmaData as $visita){

            foreach($visita->roteiros as $roteiro){

                if($totalPessoasVisitantes > $roteiro->lotacao){
                    return false;
                }
            }
        }

        return true;
    }
}

