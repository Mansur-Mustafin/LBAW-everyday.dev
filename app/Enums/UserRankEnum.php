<?php

namespace App\Enums;

enum UserRankEnum: string
{
    case NOOBIE = 'noobie';
    case CODE_MONKEY = 'code monkey';
    case SPAGHETTI_CODE_CHEF = 'spaghetti code chef';
    case ROCK_STAR = 'rock star';
    case DEVELOPER_10X = '10x developer';
    case ERROR_EVADER_404 = '404 error evader';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
