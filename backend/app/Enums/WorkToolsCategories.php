<?php

namespace App\Enums;

enum WorkToolsCategories: string
{
    case GAME = 'game';
    case PUZZLE = 'puzzle';
    case BOOK = 'book';
    case EXERCISES = 'exercises';
    case APPLICATION = 'application';

    /**
     * @return array<string>
     */
    public static function getAllValues(): array
    {
        return array_map(fn ($item) => $item->value, self::cases());
    }
}
