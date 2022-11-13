<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    public const CHO_XAC_NHAN = 0;
    public const DANG_GIAO_HANG = 1;
    public const DA_GIAO_HANG = 2;
    public const GIAO_HANG_THAT_BAI = 3;
    public const DA_HUY = 4;
}
