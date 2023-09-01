<?php

declare(strict_types=1);

namespace App\Enum;

enum GenderEnum: string
{
    case MALE = 'male';

    case FEMALE = 'female';

    case NON_BINARY = 'non_binary';

    public final const VALUES = [
        self::MALE->value,
        self::FEMALE->value,
        self::NON_BINARY->value,
    ];
}
