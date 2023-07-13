<?php

namespace App\Enums;

enum WorkToolsTypes: string
{
    case TOY = 'toy';
    case IMAGES = 'images';
    case AUDIO = 'audio';
    case VIDEO = 'video';
    case APPLICATION = 'application';

    /**
     * @return array<string>
     */
    public static function getAllValues(): array
    {
        return array_map(fn ($item) => $item->value, self::cases());
    }
}
