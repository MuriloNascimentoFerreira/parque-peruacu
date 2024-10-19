<?php

namespace App\Traits;

use App\Models\Visita;
use App\Models\Roteiro;

trait VerificaDisponibilidadeVisita
{
    public function verificaDisponibilidadeVisita($visita)
    {
       //Com base na quantidade de pessoas e nos roteiros escolhidos, verificar se a quantidade de pessoas não ultrapassa a menor quantidade maxima permitida dos roteiros.
        $roteiroLotacaoMaxima = Visita::query()
            ->join('roteiro_visita', 'visitas.id', '=', 'roteiro_visita.visita_id')
            ->join('roteiros', 'roteiro_visita.roteiro_id', '=', 'roteiros.id')
            ->min('roteiros.lotacao');

        dd($roteiroLotacaoMaxima);
        //procurar pelas visitas na mesma data, depois procurar pelos roteiros dessa visita, depois procurar pelo roteiros com a quantidade maxima menor da lista.

        // Assim vou saber que a quantidade solicitada está dentro da quantidade maxima permitida dos roteiros

        //caso a quantidade não seja permitida, retornar uma mensagem para rota de visita, informando que para essa data não tem essa quantidade de pessoas.
        //Fazer um job que verifica se uma visita não tem roteiros cadastrados, então deletar a visita.

        // Verificar a data disponivel e retornar msg informando-a
        // caso a quantidade de pessoas for maior que o limite maximo dos roteiros, mesmo sem nenhuma outra visita agendada, informar que a quantidade maxima do roteiro é X. apagar a visita?
    }
}

