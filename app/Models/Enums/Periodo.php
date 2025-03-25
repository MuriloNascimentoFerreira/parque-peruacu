<?php

namespace App\Models\Enums;

enum Periodo: int
{
    case PERIODO_MATUTINO = 1;
    case PERIODO_VESPERTINO = 2;

    public function getDescription(): string
    {
        return match ($this) {
            self::PERIODO_MATUTINO => 'Matutino',
            self::PERIODO_VESPERTINO => 'Vespertino',
        };
    }
}
