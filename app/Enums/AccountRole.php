<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class AccountRole extends Enum
{
    public const USER=0;
    public const ADMIN=1;
}