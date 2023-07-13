<?php

namespace App\Enums;

enum WorkToolsAges: string
{
    case FROM_0_TO_3 = 'FROM_0_TO_3';
    case FROM_3_TO_6 = 'FROM_3_TO_6';
    case FROM_6_TO_12 = 'FROM_6_TO_12';
    case FROM_12_TO_15 = 'FROM_12_TO_15';
    case ABOVE_15 = 'ABOVE_15';

    /**
     * @return array<string>
     */
    public static function getAllValues(): array
    {
        return array_map(fn ($item) => $item->value, self::cases());
    }
}
