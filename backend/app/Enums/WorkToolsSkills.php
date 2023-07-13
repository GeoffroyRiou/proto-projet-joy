<?php

namespace App\Enums;

enum WorkToolsSkills: string
{
    case ATTENTION = 'attention';
    case ARTICULATION = 'articulation';
    case PHONOLOGY = 'phonology';

    /**
     * @return array<string>
     */
    public static function getAllValues(): array
    {
        return array_map(fn ($item) => $item->value, self::cases());
    }
}
