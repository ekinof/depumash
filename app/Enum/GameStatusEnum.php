<?php

declare(strict_types=1);

namespace App\Enum;

enum GameStatusEnum: string
{
    case CREATED = 'created';

    case PLAYED = 'played';

    case EXPIRED = 'expired';

    public final const VALUES = [
        self::CREATED->value,
        self::PLAYED->value,
        self::EXPIRED->value,
    ];
}
