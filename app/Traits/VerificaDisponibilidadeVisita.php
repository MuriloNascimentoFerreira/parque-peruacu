<?php

namespace App\Traits;

use App\Models\Visita;
use App\Models\Roteiro;

trait VerificaDisponibilidadeVisita
{
    public function verificaDisponibilidadeVisita($visita)
    {

        //procurar pelas visitas na mesma data, depois procurar pelos roteiros dessa visita, depois procurar pelo roteiros com a quantidade maxima menor da lista.

        // Assim vou saber que a quantidade solicitada está dentro da quantidade maxima permitida dos roteiros

        //caso a quantidade não seja permitida, retornar uma mensagem para rota de visita, informando que para essa data não tem essa quantidade de pessoas.
        //Fazer um job que verifica se uma visita não tem roteiros cadastrados, então deletar a visita.

        // Verificar a data disponivel e retornar msg informando-a
        // caso a quantidade de pessoas for maior que o limite maximo dos roteiros, mesmo sem nenhuma outra visita agendada, informar que a quantidade maxima do roteiro é X. apagar a visita?


        $visitasComMesmaData = Visita::whereDate('data',$visita->data)->get();

        if(empty($visitasComMesmaData)) return true;

        $totalPessoasVisitantes = $visitasComMesmaData->sum('quantidadePessoas') + $visita->quantidadePessoas;

        foreach($visitasComMesmaData as $visita){
            $lotacaoRoteiros = $visita->roteiros()->sum('lotacao');

            // da para comparar apenas com roteiro que tem a menor lotação

                foreach($visita->roteiros as $roteiro){

                    if($totalPessoasVisitantes > $roteiro->lotacao){
                        return false;
                    }
                }
        }

        return true;

        // validar a quantidade de pessoas de acordo com o roteiro com menor lotação
        // Colocar na request;

    }

}

/**
 * visita 1 = 15 pessoas -> roteiro 1(lotacao 30)
 *                       -> roteiro 2(lotacao 32)
 *
 * visita 2 = 16 pessoas -> roteiro 1(lotacao 30)
 *                       ->roteiro 2(lotacao 32)
 *
 *
 * quantidade de pessoas = 31 + 1
 *
 * quantidade de pessoas solicitadas = 1
 *
 *
 */


