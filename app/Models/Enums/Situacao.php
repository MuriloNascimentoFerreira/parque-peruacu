<?php

namespace App\Models\Enums;

enum Situacao: int
{
    case SITUACAO_PENDENTE = 1;
    case SITUACAO_AGENDADA = 2;
    case SITUACAO_CANCELADA = 3;
    case SITUACAO_RECUSADA = 4;
    case SITUACAO_CONCLUIDA = 5;

    public function getDescription(): string
    {
        return match ($this) {
            self::SITUACAO_PENDENTE => 'Pendente',
            self::SITUACAO_AGENDADA => 'Agendada',
            self::SITUACAO_CANCELADA => 'Cancelada',
            self::SITUACAO_RECUSADA => 'Recusada',
            self::SITUACAO_CONCLUIDA => 'Concluída'
        };
    }
    
    public static function get(int $value): string
    {
        return collect(self::cases())->firstWhere('value', $value)->getDescription();
    }
}
