<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AccountHome extends Enum
{
    public const USER_HOME='/user';
    public const ADMIN_HOME='/admin/home';
}
