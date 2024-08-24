<?php

namespace App\Models\Enums;

enum Niveis: int
{
    case NIVEL_MUITO_FACIL = 1;
    case NIVEL_FACIL = 2;
    case NIVEL_MODERADO = 3;
    case NIVEL_DIFICIL = 4;
    case NIVEL_MUITO_DIFICIL = 5;

    public function getDescription(): string
    {
        return match ($this) {
            self::NIVEL_MUITO_FACIL => 'Muito Fácil',
            self::NIVEL_FACIL => 'Fácil',
            self::NIVEL_MODERADO => 'Moderado',
            self::NIVEL_DIFICIL => 'Difícil',
            self::NIVEL_MUITO_DIFICIL => 'Muito Difícil',
        };
    }
}
