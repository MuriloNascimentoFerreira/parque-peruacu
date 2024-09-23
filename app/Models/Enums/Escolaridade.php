<?php

namespace App\Models\Enums;

enum Escolaridade: int {
    case FUNDAMENTAL_INCOMPLETO = 1;
    case FUNDAMENTAL_COMPLETO = 2;
    case MEDIO_INCOMPLETO = 3;
    case MEDIO_COMPLETO = 4;
    case SUPERIOR_INCOMPLETO = 5;
    case SUPERIOR_COMPLETO = 6;
    case POS_GRADUACAO = 7;
    case MESTRADO = 8;
    case DOUTORADO = 9;
    case SEM_ESCOLARIDADE = 10;


    public function getDescription(): string
    {
        return match ($this) {
            self::FUNDAMENTAL_INCOMPLETO => 'Fundamental Incompleto',
            self::FUNDAMENTAL_COMPLETO => 'Fundamental Completo',
            self::MEDIO_INCOMPLETO => 'Médio Incompleto',
            self::MEDIO_COMPLETO => 'Médio Completo',
            self::SUPERIOR_INCOMPLETO => 'Superior Incompleto',
            self::SUPERIOR_COMPLETO => 'Superior Completo',
            self::POS_GRADUACAO => 'Pós-Graduação',
            self::MESTRADO => 'Mestrado',
            self::DOUTORADO => 'Doutorado',
            self::SEM_ESCOLARIDADE => 'Sem Escolaridade',
        };
    }

    public static function get(int $value): string
    {
        return collect(self::cases())->firstWhere('value', $value)->getDescription();
    }
}
